<?php

namespace Database\Seeders;

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
                'email' => 'johndoe@mail.com',
                'password' => '$2b$12$ma3bfhM9/ucsyMJbMII2GOKIVHvnXh4b.l62cTsf5ta8jFC2coSaK',
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'teacher',
            ],
            [
                'name' => 'Alice Smith',
                'email' => 'alicesmith@mail.com',
                'password' => '$2b$12$ma3bfhM9/ucsyMJbMII2GOKIVHvnXh4b.l62cTsf5ta8jFC2coSaK',
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'student',
            ],
            [
                'name' => 'David Brown',
                'email' => 'davidbrown@mail.com',
                'password' => '$2b$12$ma3bfhM9/ucsyMJbMII2GOKIVHvnXh4b.l62cTsf5ta8jFC2coSaK',
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'student',
            ],
            [
                'name' => 'Emily Johnson',
                'email' => 'emilyjohnson@mail.com',
                'password' => '$2b$12$ma3bfhM9/ucsyMJbMII2GOKIVHvnXh4b.l62cTsf5ta8jFC2coSaK',
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'student',
            ],
            [
                'name' => 'Michael Davis',
                'email' => 'michaeldavis@mail.com',
                'password' => '$2b$12$ma3bfhM9/ucsyMJbMII2GOKIVHvnXh4b.l62cTsf5ta8jFC2coSaK',
                'created_at' => now(),
                'role' => 'admin',
                'updated_at' => now(),
            ],

        ];

        DB::table('users')->insert($usersData);
    }
}
