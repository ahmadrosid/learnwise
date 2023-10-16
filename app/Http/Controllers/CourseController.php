<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {

        return view(
            'welcome',
            ['courses' => Course::withCount('chapters')->join('categories', 'categories.id', '=', 'courses.category_id')->select('courses.thumbnail', 'courses.title', 'courses.id', 'courses.price', 'categories.name as category_name')->get()]
        );
    }
}
