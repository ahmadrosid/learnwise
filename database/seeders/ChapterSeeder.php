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
            [
                'title' => 'Introduction | Is programming for me?',
                'description' => 'In this chapter you find out what it takes to be a software developer which further gives you quite a clear idea whether you believe you are the person for the job.',
                'course_id' => 4,
                'is_free' => 1,
                'is_published' => 1,
                'position' => 1,
                'video_url' => 'chapter6_video.mp4',
            ],
            [
                'title' => 'Yes! I am the person for the job! What\'s next?',
                'description' => 'This chapter will provide you with fundamental of software development in general, tools that you need and many more',
                'course_id' => 4,
                'is_free' => 3,
                'is_published' => 1,
                'position' => 1,
                'video_url' => 'chapter7_video.mp4',
            ],
            [
                'title' => 'Where do you get that?',
                'description' => 'We dive deeper into the core of the universe by exploring the ...',
                'course_id' => 4,
                'is_free' => 1,
                'is_published' => 1,
                'position' => 6,
                'video_url' => 3,
            ]
        ];

        DB::table('chapters')->insert($chaptersData);
    }
}
