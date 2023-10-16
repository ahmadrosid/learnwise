<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {

        return view('welcome', ['courses' => Course::with(['chapters', 'category'])->get()]);
    }
}
