<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Progress;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $category = null;
        $query = Course::select('courses.id', 'courses.slug', 'courses.title', 'courses.thumbnail', 'courses.price', 'courses.category_id', DB::raw('SUM(IF(chapters.is_published, 1, 0)) as chapters_count'), 'categories.name as category_name')
            ->leftJoin('chapters', 'courses.id', '=', 'chapters.course_id')
            ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
            ->groupBy('courses.id', 'courses.title', 'courses.thumbnail', 'courses.price', 'courses.category_id', 'categories.name')
            ->where('courses.is_published', true);

        if ($categorySlug = $request->input('category')) {
            $category = Category::where('slug', $categorySlug)->first();
            $query->where('courses.category_id', $category->id);
        }

        return view('welcome', [
            'courses' => $query->paginate(9),
            'categories' => Category::all(),
            'category' => $category,
        ]);
    }

    public function show($slug)
    {

        $course = Course::select('courses.*')->with('chapters')->where('slug', $slug)->firstOrFail();
        $chapters = Chapter::sort($course->chapters, 'student');
        $freeChapters = Chapter::getFreeChapters($chapters);
        $videoCourseDuration = Chapter::getTotalDuration($chapters);
        $firstFreeChapter = Chapter::where('course_id', $course->id)->where('is_free', 1)->first();
        $sections = Section::select('sections.*')->with('chapters')->where('course_id', $course->id)->get();
        $isEnrolled = auth()->check() ? Payment::where('user_id', auth()->user()->id)
            ->where('course_id', $course->id)->where('status', 'settled')->count() === 1 : false;

        return view('courses.index', [
            'course' => $course,
            'slug' => $slug,
            'isEnrolled' => $isEnrolled,
            'chapters' => $chapters,
            'isTheCreator' => auth()->id() === $course['user_id'],
            'sections' => $sections,
            'freeChapters' => $freeChapters,
            'firstFreeChapter' => $firstFreeChapter->video_url,
            'videoCourseDuration' => $videoCourseDuration,
        ]);

    }

    public function showchapter($slug, $chapter)
    {
        $course = Course::select('courses.*')->with('chapters')->where('slug', $slug)->firstOrFail();
        $chapters = Chapter::sort($course->chapters, 'student');
        $chapterData = array_filter($chapters, fn ($item) => $item['position'] == $chapter);
        $isChapterFinished = false;
        $sections = $course->sections;
        $activeSession = reset($chapterData)['section_id'];

        if (count($chapterData) == 0) {
            return abort(404);
        }

        $isEnrolled = auth()->check() ? Payment::where('user_id', auth()->user()->id)
            ->where('course_id', $course->id)->where('status', 'settled')->count() === 1 : false;

        if ($isEnrolled) {
            $chapterId = reset($chapterData)['id'];
            $isChapterFinished = Progress::where('user_id', auth()->user()->id)
                ->where('course_id', $course->id)
                ->where('chapter_id', $chapterId)
                ->exists();
        }

        return view('courses.chapter', [
            'course' => $course,
            'slug' => $slug,
            'chapter' => reset($chapterData),
            'chapterPosition' => $chapter,
            'isEnrolled' => $isEnrolled,
            'isChapterFinished' => $isChapterFinished,
            'chapters' => $chapters,
            'isTheCreator' => auth()->id() === $course['user_id'],
            'sections' => $sections,
            'activeSession' => $activeSession,
        ]);
    }
}
