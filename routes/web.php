<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

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

Route::get('/courses/mycourses', function () {
    return view('courses.mycourse');
});

Route::get('/teacher', function () {
    return view('teachers.index');
});

Route::get('/teacher/course/setup', function () {
    return view('teachers.course.setup');
});

require __DIR__ . '/auth.php';
