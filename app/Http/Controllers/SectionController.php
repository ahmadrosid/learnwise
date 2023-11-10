<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function store(Request $request)
    {
        $title = $request['section_title'];
        $course_id = $request['course_id'];

        Section::create([
            'title' => $title,
            'course_id' => $course_id,
            'next_section_id' => null,
        ]);

        return redirect()->back();
    }
}
