<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Course;
use \App\Models\Category;
use App\Models\Chapter;
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
        $chapterData = Chapter::select('*')
            ->where('course_id', $course->id)->where('position', $chapter)->firstOrFail();


        return view('courses.chapter', [
            "isFree" => true,
            "isLocked" => false,
            "course" => $course,
            "slug" => $slug,
            "chapter" => $chapterData,
            "chapterPosition" => $chapter
        ]);
    }
}
