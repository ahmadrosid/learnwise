<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserCourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourseController::class, 'index']);
Route::get('/dashboard', [CourseController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/courses/mycourses', [UserCourseController::class, 'show']);
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher', [TeacherController::class, 'index']);
    Route::get('/teacher/course/create', [TeacherController::class, 'create']);
    Route::post('/teacher/course', [TeacherController::class, 'store'])->name('teacher.course.store');
    Route::put('/teacher/course/{course}', [TeacherController::class, 'update'])->name('teacher.course.update');
    Route::put('/teacher/course/update/{course}/thumbnail', [TeacherController::class, 'updatethumbnail'])->name('teacher.course.update.thumbnail');
    Route::get('/teacher/course/setup/{course}', [TeacherController::class, 'edit'])->name('teacher.course.setup');

    Route::put('/teacher/course/{course}/publish', [TeacherController::class, 'publish']);
    Route::delete('/teacher/course/{course}/delete', [TeacherController::class, 'delete']);
    Route::get('/teacher/chapter/edit/{id}', [ChapterController::class, 'index']);
    Route::put('/teacher/chapter/update/{chapter}', [ChapterController::class, 'update']);
    Route::put('/teacher/chapter/update/{chapter}/video', [ChapterController::class, 'updatevideo']);
    Route::post('/teacher/chapter/create', [ChapterController::class, 'store']);
    Route::delete('/teacher/chapter/delete/{chapter}', [ChapterController::class, 'delete']);
    Route::put('/teacher/chapter/publish/{chapter}', [ChapterController::class, 'publish']);
    Route::get('/teacher/analytics', [TeacherController::class, 'analytics']);
    Route::get('/api/teacher/revenue', [TeacherController::class,  'revenue']);
});

Route::get('/courses/{slug}/chapter/{chapter}', [CourseController::class, 'show']);

Route::get('/courses/chapter-free', function () {
    return view('courses.chapter', [
        'isFree' => true,
        'isLocked' => false,
        'title' => 'Fullstack Saas Laravel',
    ]);
});

Route::get('/courses/chapter-lock', function () {
    return view('courses.chapter', [
        'isFree' => false,
        'isLocked' => true,
        'title' => 'Fullstack Saas Laravel',
    ]);
});

Route::put('/teacher/chapter/updateorders', [ChapterController::class, 'updateorders']);

require __DIR__ . '/auth.php';
