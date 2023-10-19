<?php

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
    Route::get('/teacher/course/setup/{slug}', [TeacherController::class, 'edit']);
});

Route::get('/courses/mycourses', [UserCourseController::class, 'show']);
Route::get('/courses/{slug}/chapter/{chapter}', [CourseController::class, 'show']);
Route::view('/teacher/chapter/create',  'teachers.chapter.create');

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

require __DIR__ . '/auth.php';
