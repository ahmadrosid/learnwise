<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Course;
use \App\Models\Category;
use App\Models\Chapter;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $category = null;
        $query = Course::select('courses.id', 'courses.slug', 'courses.title', 'courses.thumbnail', 'courses.price', 'courses.category_id', DB::raw('COUNT(chapters.course_id) as chapters_count'), 'categories.name as category_name')
            ->leftJoin('chapters', 'courses.id', '=', 'chapters.course_id')
            ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
            ->groupBy('courses.id', 'courses.title', 'courses.thumbnail', 'courses.price', 'courses.category_id', 'categories.name');

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

    public function show($slug, $chapter)
    {
        $course = Course::select('courses.*')->with('chapters')->where('slug', $slug)->firstOrFail();
        $chapterData = $course->chapters->collect()->first(function ($item) use ($chapter) {
            return $item->position == $chapter;
        });

        $isEnrolled = auth()->check() ? Purchase::where('user_id', auth()->user()->id)
            ->where('course_id', $course->id)->count() === 1 : false;

        return view('courses.chapter', [
            "course" => $course,
            "slug" => $slug,
            "chapter" => $chapterData,
            "chapterPosition" => $chapter,
            "isEnrolled" => $isEnrolled,
        ]);
    }

    public function showmycourses()
    {
        $enrolledCourses = Purchase::select('course_id')->where('user_id', auth()->user()->id)->get();
        $enrolledCourseIds = $enrolledCourses->pluck('course_id')->all();

        $courses = Course::select(
            'courses.id',
            'courses.slug',
            'courses.title',
            'courses.thumbnail',
            'courses.price',
            'courses.category_id',
            'categories.name as category_name',
            DB::raw('COUNT(chapters.course_id) as chapters_count'),
            DB::raw('(SELECT COUNT(*) FROM progresses WHERE progresses.course_id = courses.id AND progresses.user_id = ' . auth()->user()->id . ') as progress_count'),
        )
            ->leftJoin('chapters', 'courses.id', '=', 'chapters.course_id')
            ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
            ->whereIn('courses.id', $enrolledCourseIds) // Filter by enrolled course IDs
            ->groupBy('courses.id', 'courses.title', 'courses.thumbnail', 'courses.price', 'courses.category_id', 'categories.name')
            ->get();

        $completedCoursesCount = $courses->filter(function ($item) {
            return $item->chapters_count == $item->progress_count;
        })->count();

        $inProgressCoursesCount = $courses->count() - $completedCoursesCount;

        // dd($completedCoursesCount);


        $info = [
            "user_id" => auth()->user()->id,
            "course_id" => $courses[0]->id,
        ];

        // dd($info);

        return view('courses.mycourse', [
            "courses" => $courses,
            "completedCoursesCount" => $completedCoursesCount,
            "inProgressCoursesCount" => $inProgressCoursesCount,
        ]);
    }
}
