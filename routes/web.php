<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserCourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourseController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher', [TeacherController::class, 'index']);
    Route::get('/teacher/course/create', [TeacherController::class, 'create']);
    Route::post('/teacher/course', [TeacherController::class, 'store']);
    Route::put('/teacher/course/{course}', [TeacherController::class, 'update'])->name('teacher.course.update');
    Route::put('/teacher/course/update/{course}/thumbnail', [TeacherController::class, 'updatethumbnail'])->name("teacher.course.update.thumbnail");
    Route::get('/teacher/course/setup/{course:slug}', [TeacherController::class, 'edit'])->name('course.setup');
    Route::get('/teacher/chapter/edit/{id}',  [ChapterController::class, 'index']);
    Route::put('/teacher/chapter/update/{chapter}', [ChapterController::class, 'update']);
    Route::put('/teacher/chapter/update/{chapter}/video', [ChapterController::class, 'updatevideo']);
    Route::post('/teacher/chapter/create', [ChapterController::class, 'store']);
    Route::delete('/teacher/chapter/delete/{chapter}', [ChapterController::class, 'delete']);
});

Route::get('/courses/mycourses', [UserCourseController::class, 'show']);
Route::get('/courses/{slug}/chapter/{chapter}', [CourseController::class, 'show']);

Route::get('/courses/chapter-free', function () {
    return view('courses.chapter', [
        "isFree" => true,
        "isLocked" => false,
        "title" => "Fullstack Saas Laravel"
    ]);
});

Route::get('/courses/chapter-lock', function () {
    return view('courses.chapter', [
        "isFree" => false,
        "isLocked" => true,
        "title" => "Fullstack Saas Laravel"
    ]);
});

Route::put('/teacher/chapter/updateorders', [ChapterController::class, 'updateorders']);

require __DIR__ . '/auth.php';
