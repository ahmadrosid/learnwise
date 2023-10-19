<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserCourseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CourseController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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

Route::get('/courses/mycourses', [UserCourseController::class, 'show']);

Route::get('/courses/{slug}/chapter/{chapter}', [CourseController::class, 'show']);

Route::get('/teacher', [TeacherController::class, 'index']);

Route::get('/teacher/course/create', [TeacherController::class, 'create']);

Route::post('/teacher/course', [TeacherController::class, 'store']);

Route::get('/teacher/course/setup', function () {
    return view('teachers.course.setup');
});

Route::get('/teacher/chapter/create', function () {
    return view('teachers.chapter.create');
});



require __DIR__ . '/auth.php';
