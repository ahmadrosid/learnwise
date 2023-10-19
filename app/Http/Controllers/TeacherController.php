<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function store(Request $request)
    {
        $slugify = new Slugify();
        $request['slug'] = $slugify->slugify($request->title) . "-" . round(microtime(true) * 1000);
        $formFields = $request->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('courses', 'slug')],
            'user_id' => 'required'
        ]);

        Course::create($formFields);
        return redirect('/teacher/course/setup');
    }
}
