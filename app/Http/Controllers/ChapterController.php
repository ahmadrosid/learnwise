<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateChapterRequest;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
        $course_id = $request['course_id'];
        $isFirstChapter = !Chapter::where('course_id', $course_id)->exists();
        $previousChapter = null;

        $formFields = $request->validate([
            'title' => 'required',
            'course_id' => 'required|numeric|exists:courses,id',
        ]);
        $newChapter = Chapter::create($formFields);
        if (!$isFirstChapter) {
            $previousChapter = Chapter::where('course_id', $request['course_id'])
                ->whereNull('next_chapter_id')
                ->first();
            $this->updateOrder($previousChapter->id, $newChapter->id);
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
            };

            foreach ($affectedChapters as $item) {
                $chapter = Chapter::where('id', $item['id'])->firstOrFail();
                $chapter->update(['next_chapter_id' => $item['next_chapter_id']]);
            }
            DB::commit();
            return response()->json(['message' => "Chapters updated"]);
        } catch (\Exception $er) {
            DB::rollback();
            return response()->json(['message' => "Error occured! {$er->getMessage()}"]);
        }
    }

    private function updateOrder($id, $nextChapterId)
    {
        return Chapter::where('id', $id)->update(['next_chapter_id' => $nextChapterId]);
    }

    public function update(UpdateChapterRequest $request, Chapter $chapter)
    {
        $chapter->update($request->validated());
        return back();
    }

    public function delete(Chapter $chapter)
    {
        $isReferenced = Chapter::where('next_chapter_id', $chapter->id)->exists();
        if ($isReferenced) {
            Chapter::where('next_chapter_id', $chapter->id)->update(['next_chapter_id' => $chapter->next_chapter_id]);
        }
        $chapter->delete();
        return  back();
    }

    public function updatevideo(Request $request, Chapter $chapter)
    {
        $formFields = null;
        if ($request->hasFile('chapter_video')) {
            $formFields['video_url'] = $request->file('chapter_video')->store('chapter-video', 'public');
        }
        $chapter->update($formFields);
        return redirect()->back();
    }
}
