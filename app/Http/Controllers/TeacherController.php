<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {

        $courses = Course::select('*')->where('user_id', auth()->user()->id)->get();

        return view('teachers.index', [
            'courses' => $courses,
        ]);
    }

    public function create()
    {
        return view('teachers.course.create');
    }
}
