<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Course;
use \App\Models\Category;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $category = $request->input('category');
        $categoryId = $categories->where('slug', $category)->first()->id;


        $query = Course::select('courses.id', 'courses.title', 'courses.thumbnail', 'courses.price', 'courses.category_id', 'categories.name as category_name')
            ->leftJoin('chapters', 'courses.id', '=', 'chapters.course_id')
            ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
            ->groupBy('courses.id', 'courses.title', 'courses.thumbnail', 'courses.price', 'courses.category_id', 'categories.name');

        if ($categoryId) {
            $query->where('courses.category_id', $categoryId);
        }

        $courses = $query->get();

        return view('welcome', [
            'courses' => $courses,
            'categories' => $categories,
            'category_id' => $categoryId,
        ]);
    }
}
