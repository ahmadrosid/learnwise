<?php

namespace Database\Seeders;

use App\Models\Chapter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChapterOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $updates = [
            1 => 3,
            2 => 4,
            5 => 6,
            6 => 7,
            8 => 9,
            9 => 10,
            10 => 11,
            11 => 12,
            12 => 13,
            13 => 14,
        ];

        foreach ($updates as $chapterId => $newNextChapterId) {
            Chapter::where('id', $chapterId)->update(['next_chapter_id' => $newNextChapterId]);
        }
    }
}
