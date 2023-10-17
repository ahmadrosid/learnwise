<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersData = [
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'password' => 'hashed_password_for_johndoe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alice Smith',
                'email' => 'alicesmith@example.com',
                'password' => 'hashed_password_for_alicesmith',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'David Brown',
                'email' => 'davidbrown@example.com',
                'password' => 'hashed_password_for_davidbrown',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Emily Johnson',
                'email' => 'emilyjohnson@example.com',
                'password' => 'hashed_password_for_emilyjohnson',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michael Davis',
                'email' => 'michaeldavis@example.com',
                'password' => 'hashed_password_for_michaeldavis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($usersData);
    }
}
