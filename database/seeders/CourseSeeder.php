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

        $categoriesData = [
            [
                'name' => 'Psychology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Art',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Photography',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Computer Science',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Programming',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categoriesData);

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
                'category_id' => 1,
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
                'category_id' => 1,
                'price' => 39.99,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => 1,
                'thumbnail' => 'https://images.unsplash.com/photo-1578574577315-3fbeb0cecdc2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1172&q=80',
            ],
        ];

        DB::table('courses')->insert($coursesData);


        $chaptersData = [
            [
                'title' => 'Understanding Human Behavior',
                'description' => 'Delve into the fundamental principles of human behavior and psychology.',
                'course_id' => 1,
                'is_free' => 1,
                'is_published' => 1,
                'position' => 1,
                'video_url' => 'chapter1_video.mp4',
            ],
            [
                'title' => 'The Art of Painting',
                'description' => 'Explore the techniques and history of various painting styles.',
                'course_id' => 2,
                'is_free' => 1,
                'is_published' => 1,
                'position' => 1,
                'video_url' => 'chapter1_video.mp4',
            ],
            [
                'title' => 'Effective Marketing Strategies',
                'description' => 'Learn how to create successful marketing campaigns and reach your target audience.',
                'course_id' => 3,
                'is_free' => 1,
                'is_published' => 1,
                'position' => 1,
                'video_url' => 'chapter1_video.mp4',
            ],
            [
                'title' => 'Psychological Disorders',
                'description' => 'Gain insights into common psychological disorders and their treatment.',
                'course_id' => 1,
                'is_free' => 1,
                'is_published' => 1,
                'position' => 2,
                'video_url' => 'chapter2_video.mp4',
            ],
            [
                'title' => 'Modern Art Movements',
                'description' => 'Discover modern art movements and their impact on contemporary art.',
                'course_id' => 2,
                'is_free' => 1,
                'is_published' => 1,
                'position' => 2,
                'video_url' => 'chapter2_video.mp4',
            ],
            [
                'title' => 'Financial Planning for Businesses',
                'description' => 'Master financial planning and management in the corporate world.',
                'course_id' => 3,
                'is_free' => 1,
                'is_published' => 1,
                'position' => 2,
                'video_url' => 'chapter2_video.mp4',
            ],
        ];

        DB::table('chapters')->insert($chaptersData);
    }
}
