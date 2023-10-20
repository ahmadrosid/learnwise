<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateChapterRequest;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;

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
        $chapterOrderData = $request->input('chapter_order');

        foreach ($chapterOrderData as $order) {
            $chapter = Chapter::find($order['id']);
            if ($chapter) {
                if ($chapter && $chapter->next_chapter_id !== $order['next_chapter_id']) {
                    $this->updateOrder($chapter->id, $order['next_chapter_id']);
                }
            }
        }
        return response()->json(['message' => "Orders updated successfully"]);
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
        // TODO: update next_chapter_id

        $isReferenced = Chapter::where('next_chapter_id', $chapter->id)->exists();

        // $isReferenced = Chapter::where('next_chapter_id', $chapter->id)->firstOrFail();
        if ($isReferenced) {
            Chapter::where('next_chapter_id', $chapter->id)->update(['next_chapter_id' => $chapter->next_chapter_id]);
        }

        // dd($isReferenced, $chapter->id);

        // Chapter::where('next_chapter_id', $chapter->id);
        $chapter->delete();
        return  back();
    }
}
