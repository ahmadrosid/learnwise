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
            [ // 1 -> 3
                'title' => 'The Art of Painting',
                'description' => 'Explore the techniques and history of various painting styles.',
                'course_id' => 2,
                'is_free' => 1,
                'is_published' => 1,
                'position' => 1,
                'video_url' => 'chapter1_video.mp4',
                'next_chapter_id' => null,
            ],
            [ // 2 -> 4
                'title' => 'Effective Marketing Strategies',
                'description' => 'Learn how to create successful marketing campaigns and reach your target audience.',
                'course_id' => 3,
                'is_free' => 1,
                'is_published' => 1,
                'position' => 1,
                'video_url' => 'chapter1_video.mp4',
                'next_chapter_id' => null,
            ],
            [ // 3 -> null
                'title' => 'Modern Art Movements',
                'description' => 'Discover modern art movements and their impact on contemporary art.',
                'course_id' => 2,
                'is_free' => 0,
                'is_published' => 1,
                'position' => 2,
                'video_url' => 'chapter2_video.mp4',
                'next_chapter_id' => null,
            ],
            [ // 4 -> null
                'title' => 'Financial Planning for Businesses',
                'description' => 'Master financial planning and management in the corporate world.',
                'course_id' => 3,
                'is_free' => 1,
                'is_published' => 1,
                'position' => 2,
                'video_url' => 'chapter2_video.mp4',
                'next_chapter_id' => null,
            ],
            [ // 5 -> 6
                'title' => 'Introduction | Is programming for me?',
                'description' => 'In this chapter you find out what it takes to be a software developer which further gives you quite a clear idea whether you believe you are the person for the job.',
                'course_id' => 4,
                'is_free' => 1,
                'is_published' => 1,
                'position' => 1,
                'video_url' => 'chapter6_video.mp4',
                'next_chapter_id' => null,
            ],
            [ // 6 -> 7
                'title' => 'Yes! I am the person for the job! What\'s next?',
                'description' => 'This chapter will provide you with fundamental of software development in general, tools that you need and many more',
                'course_id' => 4,
                'is_free' => 3,
                'is_published' => 1,
                'position' => 2,
                'video_url' => 'chapter7_video.mp4',
                'next_chapter_id' => null,
            ],
            [ // 7 -> null
                'title' => 'Where do you get that?',
                'description' => 'We dive deeper into the core of the universe by exploring the ...',
                'course_id' => 4,
                'is_free' => 1,
                'is_published' => 1,
                'position' => 3,
                'video_url' => 3,
                'next_chapter_id' => null,
            ],

            [ // 8 -> 9
                'title' =>  'Exploring the Basics',
                'description' => 'An Introduction to Psychology and Human Behavior',
                'course_id' => 1,
                'is_free' => true,
                'is_published' => false,
                'position' => 1,
                'video_url' => 'chapter1_video.mp4',
                'next_chapter_id' => null,
            ],
            [ // 9 -> 10
                'title' => 'The Mind Unveiled',
                'description' => 'A Beginner\'s Guide to Understanding Human Behavior',
                'course_id' => 1,
                'is_free' => false,
                'is_published' => false,
                'position' => 2,
                'video_url' => 'chapter1_video.mp4',
                'next_chapter_id' => null,
            ],
            [ // 10 -> 11
                'title' => 'Psychology 101',
                'description' => 'A Primer on the Fundamentals of Human Behavior',
                'course_id' => 1,
                'is_free' => false,
                'is_published' => false,
                'position' => 3,
                'video_url' => 'chapter1_video.mp4',
                'next_chapter_id' => null,
            ],
            [ // 11 -> 12
                'title' => 'Nature vs. Nurture',
                'description' => 'The Role of Genetics and Environment in Human Behavior',
                'course_id' => 1,
                'is_free' => false,
                'is_published' => false,
                'position' => 4,
                'video_url' => 'chapter1_video.mp4',
                'next_chapter_id' => null,
            ],
            [ // 12 -> 13
                'title' => 'The Psychology of Emotions',
                'description' => 'How Feelings Shape Human Behavior',
                'course_id' => 1,
                'is_free' => false,
                'is_published' => false,
                'position' => 5,
                'video_url' => 'chapter1_video.mp4',
                'next_chapter_id' => null,
            ],
            [  // 13 -> 14
                'title' => 'Cognitive Processes',
                'description' => 'Unraveling the Mysteries of Human Thinking and Decision-Making',
                'course_id' => 1,
                'is_free' => false,
                'is_published' => false,
                'position' => 6,
                'video_url' => 'chapter1_video.mp4',
                'next_chapter_id' => null,
            ],
            [ // 14 -> null

                'title' => 'Applied Psychology',
                'description' => 'Practical Insights into Understanding and Influencing Human Behavior',
                'course_id' => 1,
                'is_free' => false,
                'is_published' => false,
                'position' => 7,
                'video_url' => 'chapter1_video.mp4',
                'next_chapter_id' => null,
            ]

        ];

        DB::table('chapters')->insert($chaptersData);
    }
}
