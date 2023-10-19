<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Purchase;
use \App\Models\Course;
use Illuminate\Support\Facades\DB;

class UserCourseController extends Controller
{
    public function show()
    {
        $enrolledCourseIds = Purchase::select('course_id')
            ->where('user_id', auth()->user()->id)
            ->get()
            ->pluck('course_id')
            ->all();

        $courses = Course::select(
            'courses.*',
            'categories.name as category_name',
            DB::raw('COUNT(chapters.course_id) as chapters_count'),
            DB::raw('(SELECT COUNT(*) FROM progresses WHERE progresses.course_id = courses.id AND progresses.user_id = ' . auth()->user()->id . ') as progress_count'),
        )
            ->leftJoin('chapters', 'courses.id', '=', 'chapters.course_id')
            ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
            ->whereIn('courses.id', $enrolledCourseIds)
            ->groupBy('courses.id', 'courses.title', 'courses.thumbnail', 'courses.price', 'courses.category_id', 'categories.name')
            ->get();


        $completedCoursesCount = $courses->filter(function ($item) {
            return $item->chapters_count == $item->progress_count;
        })->count();

        $inProgressCoursesCount = $courses->count() - $completedCoursesCount;

        return view('courses.mycourse', [
            "courses" => $courses,
            "completedCoursesCount" => $completedCoursesCount,
            "inProgressCoursesCount" => $inProgressCoursesCount,
        ]);
    }

    public function store()
    {
    }
}
