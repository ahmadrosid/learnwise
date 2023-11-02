<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCourseRequest;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
        $request['slug'] = Str::of($request->title)->slug('-');
        $formFields = $request->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('courses', 'slug')],
            'user_id' => 'required',
        ]);

        $course = Course::create($formFields);

        return redirect(route('teacher.course.setup', $course->slug));
    }

    public function edit(Course $course)
    {
        return view('teachers.course.setup', [
            'course' => $course,
            'categories' => Category::all(),
            'chapters' => Chapter::sort($course->chapters, 'teacher'),
            'hasBeenSold' => $course->purchases->count() > 0,
        ]);
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return redirect(route('teacher.course.setup', $course->slug));
    }

    public function updatethumbnail(Request $request, Course $course)
    {
        $formFields = null;
        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $formFields['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $course->update($formFields);

        return redirect()->back();
    }

    public function publish(Request $request)
    {
        $id = $request['id'];
        $course = Course::where('id', $id)->first();

        if ($course) {
            $course->update(['is_published' => ! $course->is_published]);
        }

        return redirect()->back();
    }

    public function delete(Course $course)
    {
        try {
            DB::beginTransaction();
            foreach ($course->chapters as $chapter) {
                $chapter->update(['next_chapter_id' => null]);
                if ($chapter->video_url) {
                    Storage::disk('public')->delete($chapter->video_url);
                }
            }

            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $course->delete();

            DB::commit();

            return redirect(route('teacher'));
        } catch (\Exception $err) {
            DB::rollBack();

            return redirect()->back();
        }
    }

    public function revenue()
    {

        $groupRevenue = Course::select('courses.title', DB::raw('SUM(courses.price) as revenue'))
            ->join('transactions', 'courses.id', '=', 'transactions.course_id')
            ->groupBy('courses.title')
            ->where('courses.user_id', auth()->user()->id)
            ->get();

        return response()->json(['data' => $groupRevenue]);
    }

    public function analytics()
    {
        $purchasesData = Transaction::select(
            'transactions.id',
            'transactions.course_id',
            'courses.title',
            'courses.price'
        )->join('courses', 'courses.id', 'transactions.course_id')
            ->where('courses.user_id', auth()->user()->id)
            ->where('transactions.status', 'settled')
            ->get();

        $totalRevenue = Transaction::join('courses', 'transactions.course_id', 'courses.id')
            ->where('courses.user_id', auth()->user()->id)
            ->where('transactions.status', 'settled')
            ->sum('courses.price');

        return view('teachers.analytics.index', [
            'data' => $purchasesData,
            'salesCount' => $purchasesData->count(),
            'totalRevenue' => $totalRevenue,
        ]);
    }

    public function balance()
    {
        $userId = auth()->user()->id;
        $transactionHistory = Transaction::select('transactions.*')
            ->leftJoin('courses', 'transactions.course_id', '=', 'courses.id')
            ->where(function ($query) use ($userId) {
                $query->where(function ($query) use ($userId) {
                    $query->where('transactions.type', 'withdraw')
                        ->where('transactions.user_id', $userId);
                })->orWhere(function ($query) use ($userId) {
                    $query->where('transactions.type', 'enroll')
                        ->where('courses.user_id', $userId);
                });
            })
            ->get();

        $balance = 0;

        foreach ($transactionHistory as $item) {
            if ($item->type === 'enroll' && $item->status === 'settled') {
                $balance += $item->amount;
            } elseif ($item->type === 'withdraw' && $item->status === 'approved') {
                $balance -= $item->amount;
            }
        }

        return view('teachers.balance', [
            'history' => $transactionHistory,
            'balance' => $balance,
        ]);
    }
}
