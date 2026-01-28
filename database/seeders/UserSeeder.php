<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin BNSP',
                'password' => bcrypt('password123'),
                'role' => 'admin'
            ]
        );

        // Create Student User
        User::firstOrCreate(
            ['email' => 'student@test.com'],
            [
                'name' => 'John Doe',
                'password' => bcrypt('password123'),
                'role' => 'student'
            ]
        );

        // Create another Student
        User::firstOrCreate(
            ['email' => 'jane@test.com'],
            [
                'name' => 'Jane Smith',
                'password' => bcrypt('password123'),
                'role' => 'student'
            ]
        );
    }
}
