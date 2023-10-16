<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // uncomment these lines below then run `php artisan migrate:refresh seed`
        /*
        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(3)->create();
        \App\Models\Chapter::factory(8)->create();
        */

        $usersQuery = <<<SQL
            INSERT INTO users (name, email, password, created_at, updated_at)
            VALUES
            ('John Doe', 'johndoe@example.com', 'hashed_password_for_johndoe', NOW(), NOW()),
            ('Alice Smith', 'alicesmith@example.com', 'hashed_password_for_alicesmith', NOW(), NOW()),
            ('David Brown', 'davidbrown@example.com', 'hashed_password_for_davidbrown', NOW(), NOW()),
            ('Emily Johnson', 'emilyjohnson@example.com', 'hashed_password_for_emilyjohnson', NOW(), NOW()),
            ('Michael Davis', 'michaeldavis@example.com', 'hashed_password_for_michaeldavis', NOW(), NOW());
        SQL;

        $categoriesQuery = <<<SQL
            INSERT INTO categories (name, created_at, updated_at)
            VALUES
            ('Psychology', NOW(), NOW()),
            ('Art', NOW(), NOW()),
            ('Business', NOW(), NOW()),
            ('Photography', NOW(), NOW()),
            ('Computer Science', NOW(), NOW()),
            ('Programming', NOW(), NOW());
        SQL;

        $coursesQuery = <<<SQL
            INSERT INTO courses (title, description, user_id, category_id, price, created_at, updated_at, is_published, thumbnail)
            VALUES
            ('Introduction to Psychology', 'Explore the human mind and behavior in this introductory psychology course.', 1, 1, 49.99, NOW(), NOW(), 1, 'https://images.unsplash.com/photo-1528642474498-1af0c17fd8c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80'),
            ('Art Appreciation and Techniques', 'Discover the world of art, from appreciation to hands-on techniques.', 2, 1, 59.99, NOW(), NOW(), 1, 'https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80'),
            ('Business Strategies for Success', 'Learn essential business strategies and tactics to achieve success in the corporate world.', 3, 1, 39.99, NOW(), NOW(), 1, 'https://images.unsplash.com/photo-1578574577315-3fbeb0cecdc2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1172&q=80');
        SQL;

        $chaptersQuery = <<<SQL
            INSERT INTO chapters (title, description, course_id, is_free, is_published, position, video_url) VALUES
            ('Understanding Human Behavior', 'Delve into the fundamental principles of human behavior and psychology.', 1, 1, 1, 1, 'chapter1_video.mp4'),
            ('The Art of Painting', 'Explore the techniques and history of various painting styles.', 2, 1, 1, 1, 'chapter1_video.mp4'),
            ('Effective Marketing Strategies', 'Learn how to create successful marketing campaigns and reach your target audience.', 3, 1, 1, 1, 'chapter1_video.mp4'),
            ('Psychological Disorders', 'Gain insights into common psychological disorders and their treatment.', 1, 1, 2, 2, 'chapter2_video.mp4'),
            ('Modern Art Movements', 'Discover modern art movements and their impact on contemporary art.', 2, 1, 2, 2, 'chapter2_video.mp4'),
            ('Financial Planning for Businesses', 'Master financial planning and management in the corporate world.', 3, 1, 2, 2, 'chapter2_video.mp4');
        SQL;


        // Execute the SQL queries
        DB::statement($usersQuery);
        DB::statement($categoriesQuery);
        DB::statement($coursesQuery);
        DB::statement($chaptersQuery);
    }
}
