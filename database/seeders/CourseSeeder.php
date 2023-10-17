<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $coursesData = [
            [
                'title' => 'Introduction to Psychology',
                'description' => 'Explore the human mind and behavior in this introductory psychology course.',
                'user_id' => 1,
                'category_id' => 1,
                'price' => 49.99,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => 1,
                'thumbnail' => 'https://images.unsplash.com/photo-1528642474498-1af0c17fd8c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80',
            ],
            [
                'title' => 'Art Appreciation and Techniques',
                'description' => 'Discover the world of art, from appreciation to hands-on techniques.',
                'user_id' => 2,
                'category_id' => 2,
                'price' => 59.99,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => 1,
                'thumbnail' => 'https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1pYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80',
            ],
            [
                'title' => 'Business Strategies for Success',
                'description' => 'Learn essential business strategies and tactics to achieve success in the corporate world.',
                'user_id' => 3,
                'category_id' => 3,
                'price' => 39.99,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => 1,
                'thumbnail' => 'https://images.unsplash.com/photo-1578574577315-3fbeb0cecdc2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1172&q=80',
            ],
        ];

        DB::table('courses')->insert($coursesData);
    }
}
