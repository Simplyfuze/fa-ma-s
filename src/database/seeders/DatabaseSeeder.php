<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $user = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);


        $group = Group::create([
            'name' => 'Admin Group',
        ]);

        $group->users()->attach($user);

    }
}
