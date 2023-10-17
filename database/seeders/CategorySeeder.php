<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesData = [
            [
                'name' => 'Psychology',
                'created_at' => now(),
                'updated_at' => now(),
                'slug' => 'psychology'
            ],
            [
                'name' => 'Art',
                'created_at' => now(),
                'updated_at' => now(),
                'slug' => 'art',
            ],
            [
                'name' => 'Business',
                'created_at' => now(),
                'updated_at' => now(),
                'slug' => 'business',
            ],
            [
                'name' => 'Photography',
                'created_at' => now(),
                'updated_at' => now(),
                'slug' => 'photography',
            ],
            [
                'name' => 'Computer Science',
                'created_at' => now(),
                'updated_at' => now(),
                'slug' => 'computer-science',
            ],
            [
                'name' => 'Programming',
                'created_at' => now(),
                'updated_at' => now(),
                'slug' => 'programming'
            ],
            [
                'name' => 'Food and Beverages',
                'created_at' => now(),
                'updated_at' => now(),
                'slug' => 'food-and beverages'
            ]
        ];

        DB::table('categories')->insert($categoriesData);
    }
}
