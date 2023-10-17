<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Course;
use \App\Models\Category;

class CourseController extends Controller
{
    public function index(Request $request)
    {

        $categoryId = $request->input('category_id');

        $courses = Course::select('courses.id', 'courses.title', 'courses.thumbnail', 'courses.price', 'courses.category_id', 'categories.name as category_name')
            ->leftJoin('chapters', 'courses.id', '=', 'chapters.course_id')
            ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
            ->groupBy('courses.id', 'courses.title', 'courses.thumbnail', 'courses.price', 'courses.category_id', 'categories.name');

        if ($categoryId) {
            $courses->where('courses.category_id', $categoryId);
        }

        $courses = $courses->get();

        return view('welcome', [
            'courses' => $courses,
            'categories' => Category::all(),
            'category_id' => $categoryId,
        ]);
    }
}
