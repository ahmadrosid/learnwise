<?php

namespace Database\Seeders;

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
                'slug' => 'introduction-to-psychology',
                'description' => 'Explore the human mind and behavior in this introductory psychology course.',
                'user_id' => 1,
                'category_id' => 1,
                'price' => 85000,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => true,
                'thumbnail' => '',
            ],
            /*
            [
                'title' => 'Art Appreciation and Techniques',
                'slug' => 'art-appreciation-and-techniques',
                'description' => 'Discover the world of art, from appreciation to hands-on techniques.',
                'user_id' => 2,
                'category_id' => 2,
                'price' => 59.99,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => 0,
                'thumbnail' => '',
            ],
            [
                'title' => 'Business Strategies for Success',
                'slug' => 'business-strategies-for-success',
                'description' => 'Learn essential business strategies and tactics to achieve success in the corporate world.',
                'user_id' => 3,
                'category_id' => 3,
                'price' => 39.99,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => false,
                'thumbnail' => '',
            ],
            [
                'title' => 'Web Developments| Where to start?',
                'slug' => 'web-developments-where-to-start',
                'description' => 'This course is intended for you who ask: Is computer programming for me?',
                'user_id' => 1,
                'category_id' => 6,
                'price' => 10.99,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => 0,
                'thumbnail' => '',
            ],

            [
                'title' => 'Understanding Color',
                'slug' => 'understanding-color',
                'description' => 'Embark on a colorful journey into the realm of art and emotion. Explore the captivating world of color, its role in conveying emotions, and its profound impact on artistic expression. Join us and gain a deeper understanding of how color influences our perceptions and the beauty it brings to the canvas of life.',
                'user_id' => 4,
                'category_id' => 2,
                'price' => 7,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => 0,
                'thumbnail' => '',
            ],
            [
                'title' => '34 Indonesian recipes that you can try at home',
                'slug' => '34-indonesian-recipes-that-you-can-try-at-home',
                'description' => 'In this course you will watch video and cook along with me and enjoy your favorite Indonesian cuisine.',
                'user_id' => 3,
                'category_id' => 7,
                'price' => 8,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => 0,
                'thumbnail' => '',
            ],
            [
                'title' => 'Photography - Become a pro shooter in 20 hours',
                'slug' => 'photography-become-a-pro-shooter-in-20-hours',
                'description' => 'This course will give you all you need to start taking beautiful pictures even with using your smartphone camera. Besides you\'ll also learn how to make it a lot nicer in photo editors softwares such as photoshop and gimp.',
                'user_id' => 5,
                'category_id' => 4,
                'price' => 4,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => 0,
                'thumbnail' => '',
            ],
            [
                'title' => 'Making Soto - One of the most iconic indonesian cuisine.',
                'slug' => 'making-soto-one-of-the-most-iconic-indonesian-cuisine.',
                'description' => 'Indonesian is rich, and soto is one of those. Here we have Soto Banjar, Soto Betawi, Soto Madura and many more.',
                'user_id' => 5,
                'category_id' => 7,
                'price' => 6,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => 0,
                'thumbnail' => '',
            ],
            [
                'title' => 'Learn Python Programming Language to Automate your daily tasks.',
                'slug' => 'learn-python-programming-language-to-automate-your-daily-tasks.',
                'description' => 'Master Python for daily task automation. Unleash the potential of Python to streamline your everyday activities. Join us and automate your life',
                'user_id' => 3,
                'category_id' => 5,
                'price' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => 0,
                'thumbnail' => '',
            ],
            */

            [
                'title' => 'Absolute Beginner Guide to Calligraphy and Beautiful Handwriting',
                'slug' => 'absolute-beginner-guide-to-calligraphy-and-beautiful-handwriting',
                'description' => 'Begin your enchanting journey into the world of calligraphy and the art of beautiful handwriting. This course is tailored for absolute beginners, offering step-by-step guidance in mastering the graceful strokes of calligraphy and the techniques behind creating stunning, artistic handwriting. Join us and unveil the secrets to crafting exquisite letters and elegant script.',
                'user_id' => 3,
                'category_id' => 2,
                'price' => 5,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => 0,
                'thumbnail' => '',
            ],
            [
                'title' => 'Understanding kids',
                'slug' => 'understanding-kids',
                'description' => 'Explore the world of child psychology and self-development. Gain valuable insights into understanding and nurturing the minds of children. Join us on this journey of discovery and growth.',
                'user_id' => 3,
                'category_id' => 1,
                'price' => 7,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => 0,
                'thumbnail' => '',
            ],
            [
                'title' => 'How to sell anything?',
                'slug' => 'how-to-sell-anything',
                'description' => 'Unlock the art of selling and grow your business exponentially. Discover the secrets of effective sales techniques, persuasion, and closing deals. Join us and learn how to confidently sell anything to anyone, driving your success to new heights.',
                'user_id' => 3,
                'category_id' => 3,
                'price' => 6,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => 0,
                'thumbnail' => '',
            ],
            [
                'title' => 'Understanding Women',
                'slug' => 'understanding-women',
                'description' => 'Delve into the complexities and insights of understanding women. Explore the nuances of relationships, communication, and personal growth. Join us on this path of self-discovery and building meaningful connections.',
                'user_id' => 3,
                'category_id' => 1,
                'price' => 7,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => 0,
                'thumbnail' => '',
            ],
            [
                'title' => 'Understanding Men',
                'slug' => 'understanding-men',
                'description' => 'Gain valuable insights into the world of men and masculinity. Explore their perspectives, behaviors, and personal development. Join us on a journey of understanding and connection.',
                'user_id' => 4,
                'category_id' => 1,
                'price' => 9,
                'created_at' => now(),
                'updated_at' => now(),
                'is_published' => 0,
                'thumbnail' => '',
            ],
        ];

        DB::table('courses')->insert($coursesData);
    }
}
