<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateChapterRequest;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Progress;
use Cloudinary\Api\Admin\AdminApi;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ChapterController extends Controller
{
    public function index($id)
    {
        $chapter = Chapter::where('id', $id)->firstOrFail();
        $course = Course::select('id', 'title', 'slug')->where('id', $chapter->course_id)->firstOrFail();

        return view('teachers.chapter.edit', [
            'chapter' => $chapter,
            'slug' => $course->slug,
        ]);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'course_id' => 'required|numeric|exists:courses,id',
        ]);

        $previousChapter = Chapter::where('course_id', $request['course_id'])
            ->whereNull('next_chapter_id')
            ->first();

        $newChapter = Chapter::create($formFields);
        if ($previousChapter) {
            $previousChapter->update(['next_chapter_id' => $newChapter->id]);
        }

        return back();
    }

    public function updateorders(Request $request)
    {
        $affectedChapters = new Collection();
        $chapterOrders = $request->input('chapter_order');

        DB::beginTransaction();
        try {

            foreach ($chapterOrders as $order) {
                $chapter = Chapter::where('id', $order['id'])->firstOrFail();
                if ($chapter->next_chapter_id !== $order['next_chapter_id']) {
                    $chapter->update(['next_chapter_id' => null]);
                    $affectedChapters->push($order);
                }
            }

            foreach ($affectedChapters as $item) {
                $chapter = Chapter::where('id', $item['id'])->firstOrFail();
                $chapter->update(['next_chapter_id' => $item['next_chapter_id']]);
            }
            DB::commit();

            return response()->json(['message' => 'Chapters updated']);
        } catch (\Exception $er) {
            DB::rollback();

            return response()->json(['message' => "Error occured! {$er->getMessage()}"]);
        }
    }

    public function update(UpdateChapterRequest $request, Chapter $chapter)
    {
        $chapter->update($request->validated());

        return back();
    }

    public function delete(Chapter $chapter)
    {
        $next_chapter_id = $chapter->next_chapter_id;
        $video_url = $chapter->video_url;
        if ($next_chapter_id) {
            $chapter->update(['next_chapter_id' => null]);
        }

        if ($video_url) {
            Storage::disk('public')->delete($video_url);
        }

        Chapter::where('next_chapter_id', $chapter->id)->update(['next_chapter_id' => $next_chapter_id]);

        $chapter->delete();

        return redirect(route('teacher.course.setup', $chapter->course->slug));
    }

    public function finish(Request $request, Chapter $chapter)
    {
        $user_id = auth()->user()->id;
        $course_id = $request['course_id'];
        $chapter_id = $chapter->id;

        $progress = Progress::where('user_id', $user_id)
            ->where('chapter_id', $chapter_id)
            ->where('course_id', $course_id)
            ->first();

        if ($progress) {
            return redirect()->back();
        }

        try {

            Progress::create([
                'user_id' => $user_id,
                'chapter_id' => $chapter_id,
                'course_id' => $course_id,
            ]);

            return redirect()->back();

        } catch (\Exception $err) {
            return redirect()->back()->withErrors(['error' => $err]);
        }

    }

    public function updatevideo(Request $request, Chapter $chapter)
    {

        Configuration::instance([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
                'api_key' => env('CLOUDINARY_API_KEY'),
            ],
            'url' => [
                'secure' => true,
            ],
        ]);

        $cloudUpload = new UploadApi();
        $cloudAdmin = new AdminApi();
        $oldVideo = $chapter->video_url;
        if ($request->hasFile('chapter_video')) {
            // this doesn't work
            // if ($chapter->video_url) {
            //     $cloudAdmin->deleteAssets($chapter->video_url);
            // }
            $uploadVideo = $cloudUpload->upload($request->file('chapter_video')->getRealPath(), [
                'resource_type' => 'video',
                'chunk_size' => 6000000,
            ]);

            // this one does not work either
            // if ($oldVideo) {
            //     $cloudAdmin->deleteAssets($chapter->video_url);
            // }
            $chapter->update(['video_url' => $uploadVideo['public_id']]);
        }

        return redirect()->back();
    }

    public function publish(Chapter $chapter)
    {
        $chapter->update(['is_published' => ! $chapter->is_published]);

        return redirect()->back();
    }
}
