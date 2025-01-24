<?php

namespace Database\Seeders;

use App\Models\Consumable;
use App\Models\Equipment;
use App\Models\Field;
use App\Models\Group;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Define constants for seeding
     */
    const USERS_COUNT = 20;
    const GROUPS_COUNT = 3;
    const FIELDS_COUNT = 8;
    const TASKS_PER_FIELD = 4;
    const EQUIPMENT_COUNT = 10;
    const CONSUMABLES_COUNT = 15;

    /**
     * Predefined data for more realistic seeding
     */
    private array $taskTypes = ['maintenance',
        'sowing','fertilizing','spraying',
        'harvesting','plowing','cultivation','other'
    ];
    private array $equipmentBrands = ['John Deere', 'Case IH', 'New Holland', 'Massey Ferguson', 'Claas'];
    private array $equipmentTypes = ['Tractor', 'Harvester', 'Sprayer', 'Combine', 'Planter', 'Cultivator', 'Baler'];
    private array $consumableTypes = ['Fertilizer', 'Seeds', 'Pesticides', ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $adminUser = User::create([
            'id' => Str::ulid(),
            'first_name' => 'Admin',
            'last_name' => 'System',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);
        $adminUser = User::create([
            'id' => Str::ulid(),
            'first_name' => 'Farmer',
            'last_name' => 'System',
            'email' => 'farmer@farmer.com',
            'password' => bcrypt('farmer'),
            'role' => 'farmer',
        ]);
        $adminUser = User::create([
            'id' => Str::ulid(),
            'first_name' => 'Worker',
            'last_name' => 'System',
            'email' => 'worker@worker.com',
            'password' => bcrypt('worker'),
            'role' => 'worker',
        ]);


        // Create regular users
        $users = User::factory(self::USERS_COUNT)->create();

        // Create groups
        $groups = collect();
        $groupNames = ['Field Operations', 'Maintenance Team', 'Logistics Team'];

        foreach ($groupNames as $groupName) {
            $groups->push(Group::create([
                'group_name' => $groupName,
            ]));
        }

        // Create equipment pool
        $equipments = collect();
        for ($i = 0; $i < self::EQUIPMENT_COUNT; $i++) {
            $brand = $this->equipmentBrands[array_rand($this->equipmentBrands)];
            $equipments->push(Equipment::create([
                'brand_name' => $brand,
                'model_name' => "Model " . chr(65 + $i),
                'equipment_type' => $this->getEquipmentType($brand),
                'registration_number' => 'AG' . str_pad($i + 1000, 4, '0', STR_PAD_LEFT),
                'year_of_manufacture' => rand(2000, 2024),
            ]));
        }

        // Create consumables pool
        $consumables = collect();
        for ($i = 0; $i < self::CONSUMABLES_COUNT; $i++) {
            $type = $this->consumableTypes[array_rand($this->consumableTypes)];
            $consumables->push(Consumable::create([
                'consumable_name' => $this->getConsumableName($type),
                'consumable_type' => $type,
            ]));
        }

        // Create fields and tasks
        for ($i = 0; $i < self::FIELDS_COUNT; $i++) {
            $field = Field::create([
                'field_name' => "Field" . ($i + 1),
                'field_size' => rand(50, 500),
            ]);

            // Create tasks for each field
            for ($j = 0; $j < self::TASKS_PER_FIELD; $j++) {
                $taskType = $this->taskTypes[array_rand($this->taskTypes)];
                $task = Task::create([
                    'task_name' => "{$taskType} for {$field->field_name}",
                    'task_description' => $this->generateTaskDescription($taskType, $field->field_name),
                    'task_type' => $taskType,
                    'task_status' => !(rand(0, 2) === 0),
                    'field_id' => $field->id,
                    'group_id' => $groups->random()->id,
                ]);

                // Assign 1-3 random users to each task
                $task->users()->attach(
                    $users->random(rand(1, 3))->pluck('id')->toArray()
                );

                // Assign 1-2 pieces of equipment to each task
                $task->equipments()->attach(
                    $equipments->random(rand(1, 2))->pluck('id')->toArray()
                );

                // Assign 1-3 consumables to each task
                $task->consumables()->attach(
                    $consumables->random(rand(1, 3))->pluck('id')->toArray(),
                );
            }
        }
    }

    /**
     * Get equipment type based on brand
     */
    private function getEquipmentType(string $brand): string
    {
        $types = [
            'John Deere' => ['Tractor', 'Harvester', 'Sprayer'],
            'Case IH' => ['Tractor', 'Combine', 'Planter'],
            'New Holland' => ['Harvester', 'Baler', 'Tractor'],
            'Massey Ferguson' => ['Tractor', 'Combine', 'Cultivator'],
            'Claas' => ['Combine', 'Forage Harvester', 'Baler'],
        ];

        return $types[$brand][array_rand($types[$brand])];
    }

    /**
     * Get consumable name based on type
     */
    private function getConsumableName(string $type): string
    {
        $names = [
            'Fertilizer' => ['NPK 16-16-16', 'Urea', 'Ammonium Nitrate'],
            'Seeds' => ['Pioneer', 'Syngenta', 'Monsanto'],
            'Pesticides' => ['Roundup', 'Atrazine', 'Glyphosate'],
        ];

        return $names[$type][array_rand($names[$type])];
    }
    /**
     * Generate a realistic task description
     */
    private function generateTaskDescription(string $taskType, string $fieldName): string
    {
        $descriptions = [
            'Planting' => "Planting {$fieldName} seeds according to optimal spacing guidelines. Check soil moisture before proceeding.",
            'Fertilizing' => "Apply fertilizer to {$fieldName} field following soil test recommendations. Ensure even distribution.",
            'Irrigation' => "Implement irrigation schedule for {$fieldName} based on current growth stage and weather conditions.",
            'Harvesting' => "Harvest {$fieldName} when optimal moisture content is reached. Monitor weather conditions.",
            'Pest Control' => "Apply approved pesticides to {$fieldName} field following integrated pest management guidelines.",
        ];

        return $descriptions[$taskType] ?? "Perform {$taskType} operation on {$fieldName} field";
    }
}
