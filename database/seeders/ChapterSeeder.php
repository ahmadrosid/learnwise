<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
