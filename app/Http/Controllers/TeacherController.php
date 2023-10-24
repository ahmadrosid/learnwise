<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class TeacherController extends Controller
{

    public function index(Request $request)
    {
        return view('teachers.index', [
            'courses' => Course::where('user_id', $request->user()->id)->get(),
        ]);
    }

    public function create()
    {
        return view('teachers.course.create');
    }

    public function store(Request $request)
    {
        $request['slug'] = Str::of($request->title)->slug("-");
        $formFields = $request->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('courses', 'slug')],
            'user_id' => 'required'
        ]);

        $course = Course::create($formFields);
        return redirect(route('course.setup', $course->slug));
    }

    private function sortChapters($chapters)
    {
        if ($chapters->count() === 0) {
            return [];
        }

        $sortedChapters = [];
        $chapterLookup = collect($chapters->keyBy('id'));
        $currentChapter = $chapterLookup->where('next_chapter_id', null)->first();
        while ($currentChapter) {
            $sortedChapters[] = $currentChapter;
            $currentChapter = $chapterLookup->where('next_chapter_id', $currentChapter->id)->first();
        }
        return array_reverse($sortedChapters);
    }

    public function edit(Course $course)
    {
        return view('teachers.course.setup', [
            'course' => $course,
            'categories' => Category::all(),
            'chapters' => $this->sortChapters($course->chapters),
        ]);
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());
        return redirect("/teacher/course/setup/" . $course->slug);
    }

    public function updatethumbnail(Request $request, Course $course)
    {
        /*
         * TODO: remove thumbnail stored when user upload a new one, we don't want them to just pile up our storage
         * We also might want to put this function inside `update` above
         **/

        $formFields = null;
        if ($request->hasFile('thumbnail')) {
            $formFields['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $course->update($formFields);
        return redirect()->back();
    }

    public function grouprevenue()
    {
        $groupRevenue = Course::select('courses.title', DB::raw('SUM(courses.price) as revenue'))
            ->join('purchases', 'courses.id', '=', 'purchases.course_id')
            ->groupBy('courses.title')
            ->where('courses.user_id', auth()->user()->id)
            ->get();

        return response()->json(['data' => $groupRevenue]);
    }

    public function analytics()
    {
        $purchasesData = Purchase::select(
            'purchases.id',
            'purchases.course_id',
            'courses.title',
            'courses.price'
        )->join('courses', 'courses.id', 'purchases.course_id')
            ->where('courses.user_id', auth()->user()->id)
            ->get();

        $totalRevenue = Purchase::join('courses', 'purchases.course_id', 'courses.id')
            ->where('courses.user_id', auth()->user()->id)
            ->sum('courses.price');

        return view('teachers.analytics.index', [
            'data' => $purchasesData,
            'salesCount' => $purchasesData->count(),
            'totalRevenue' => $totalRevenue,
        ]);
    }
}
