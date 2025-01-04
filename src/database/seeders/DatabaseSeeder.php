<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $adminUser = User::create([
            'id'=> Str::ulid(),
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        $group = Group::create([
            'group_name' => 'Admin Group',
        ]);


        for ($i = 0; $i < 5; $i++) {
            $field = \App\Models\Field::create([
                'field_name' => 'Field ' . $i,
                'field_size' => rand(10, 100),
            ]);

            for ($j = 0; $j < 3; $j++) {
                $task = \App\Models\Task::create([
                    'task_name' => 'Task ' . $j . ' for Field ' . $i,
                    'task_description' => 'Task ' . $j . ' for Field ' . $i,
                    'task_type' => 'type_' . $j,
                    'task_status' => false,
                    'field_id' => $field->id,
                    'group_id' => $group->id,
                ]);

                $task->users()->attach(User::inRandomOrder()->first());

                $equipment = \App\Models\Equipment::create([
                    'brand_name' => 'Brand ' . $j,
                    'model_name' => 'Model ' . $j,
                    'registration_number' => 'REG' . rand(1000, 9999),
                    'year_of_manufacture' => rand(2000, 2023),
                ]);

                $consumable = \App\Models\Consumable::create([
                    'consumable_name' => 'Consumable ' . $j,
                    'consumable_type' => 'Type_' . $j,
                ]);

                $task->equipments()->attach($equipment);
                $task->consumables()->attach($consumable);
            }
        }

    }
}
