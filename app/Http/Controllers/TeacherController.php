<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {

        $isATeacher = false;
        $courses = null;

        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role === 'teacher') {
                $isATeacher = true;
                $courses = Course::select('*')->where('user_id', $user->id)->get();
            }
        }
        if ($isATeacher) {

            return view('teachers.index', [
                'courses' => $courses,
            ]);
        } else {
            return redirect("/");
        }
    }

    public function create()
    {
        return view('teachers.course.create');
    }
}
