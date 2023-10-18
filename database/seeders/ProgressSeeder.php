<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $progressData = [
            [
                'user_id' => 2,
                'course_id' => 1,
                'chapter_id' => 8,
            ],
            [
                'user_id' => 2,
                'course_id' => 1,
                'chapter_id' => 9,
            ],

            [
                'user_id' => 2,
                'course_id' => 1,
                'chapter_id' => 10,
            ],

        ];

        DB::table('progresses')->insert($progressData);
    }
}
