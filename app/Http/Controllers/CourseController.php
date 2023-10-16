<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {

        return view('welcome', ['courses' => DB::table('courses')
            ->select('courses.id', 'courses.title', 'courses.thumbnail', 'courses.price', 'courses.category_id', DB::raw('COUNT(chapters.course_id) as chapters_count'), 'categories.name as category_name')
            ->leftJoin('chapters', 'courses.id', '=', 'chapters.course_id')
            ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
            ->groupBy('courses.id', 'courses.title', 'courses.thumbnail', 'courses.price', 'courses.category_id', 'categories.name')
            ->get()]);
    }
}
