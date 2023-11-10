<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description',  'course_id', 'is_published', 'is_free', 'position', 'video_url', 'next_chapter_id', 'video_source', 'section_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    /*
     * type can be either 'student' or 'teacher',
     * with teacher having all the records, and student with only those that are published
     **/

    public static function sort($chapters, $type)
    {
        if ($chapters->count() === 0) {
            return [];
        }

        $sortedChapters = [];
        $chapterLookup = collect($chapters->keyBy('id'));
        $position = $chapters->count();
        $currentChapter = $chapterLookup->where('next_chapter_id', null)->first();
        while ($currentChapter) {
            $currentChapter['position'] = $position;
            $sortedChapters[] = $currentChapter;
            $currentChapter = $chapterLookup->where('next_chapter_id', $currentChapter->id)->first();
            $position--;
        }

        if ($type === 'student') {
            $sortedChapters = array_filter($sortedChapters, function ($chapter) {
                return $chapter->is_published;
            });
        }

        return array_reverse($sortedChapters);
    }
}
