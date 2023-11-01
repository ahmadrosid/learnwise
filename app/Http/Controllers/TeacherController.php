<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCourseRequest;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Purchase;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;
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
        $imgUrl = env('PUBLIC_CLOUDINARY_URL');

        return view('teachers.course.setup', [
            'course' => $course,
            'categories' => Category::all(),
            'chapters' => Chapter::sort($course->chapters, 'teacher'),
            'hasBeenSold' => $course->purchases->count() > 0,
            'imgUrl' => $imgUrl,
        ]);
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return redirect(route('teacher.course.setup', $course->slug));
    }

    public function updatethumbnail(Request $request, Course $course)
    {

        Configuration::instance(
            [
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                    'api_key' => env('CLOUDINARY_API_KEY'),
                ],
                'url' => [
                    'secure' => true,
                ],
            ]
        );
        $cloudUpload = new UploadApi();
        if ($request->hasFile('thumbnail')) {
            $uploadImage = $cloudUpload->upload($request->file('thumbnail')->getRealPath());
            $course->update(['thumbnail' => $uploadImage['public_id']]);
        }

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
