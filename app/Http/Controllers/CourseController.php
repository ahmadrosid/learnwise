<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Course;
use \App\Models\Category;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::select('name', 'id', 'slug')->get();
        $categorySlug = $request->input('category');
        $categoryName = "";
        $categoryId = 0;

        if ($categorySlug) {
            $category = $categories->where('slug', $categorySlug)->first();
            $categoryId = $category->id;
            $categoryName =  $category->name;
        }


        $query = Course::select('courses.id', 'courses.title', 'courses.thumbnail', 'courses.price', 'courses.category_id', DB::raw('COUNT(chapters.course_id) as chapters_count'), 'categories.name as category_name')
            ->leftJoin('chapters', 'courses.id', '=', 'chapters.course_id')
            ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
            ->groupBy('courses.id', 'courses.title', 'courses.thumbnail', 'courses.price', 'courses.category_id', 'categories.name');

        if ($categoryId) {
            $query->where('courses.category_id', $categoryId);
        }

        $courses = $query->paginate(3);

        return view('welcome', [
            'courses' => $courses,
            'categories' => $categories,
            'category_id' => $categoryId,
            'category' => $categoryName,
        ]);
    }
}
