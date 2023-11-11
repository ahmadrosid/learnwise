<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserCourseController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourseController::class, 'index']);
Route::get('/dashboard', [CourseController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/courses/mycourses', [UserCourseController::class, 'show'])->name('mycourse');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher');
    Route::get('/teacher/course/create', [TeacherController::class, 'create'])->name('teacher.course.create');
    Route::post('/teacher/course', [TeacherController::class, 'store'])->name('teacher.course.store');
    Route::put('/teacher/course/{course}', [TeacherController::class, 'update'])->name('teacher.course.update');
    Route::put('/teacher/course/update/{course}/thumbnail', [TeacherController::class, 'updatethumbnail'])->name('teacher.course.update.thumbnail');
    Route::get('/teacher/course/setup/{course}', [TeacherController::class, 'edit'])->name('teacher.course.setup');

    Route::put('/teacher/course/{course}/publish', [TeacherController::class, 'publish'])->name('teacher.course.publish');
    Route::delete('/teacher/course/{course}/delete', [TeacherController::class, 'delete'])->name('teacher.course.delete');
    Route::get('/teacher/chapter/edit/{id}', [ChapterController::class, 'index']);
    Route::put('/teacher/chapter/update/{chapter}', [ChapterController::class, 'update'])->name('teacher.chapter.update');
    Route::put('/teacher/chapter/update/{chapter}/video', [ChapterController::class, 'updatevideo'])->name('teacher.chapter.update.video');
    Route::post('/teacher/chapter/store', [ChapterController::class, 'store'])->name('teacher.chapter.store');
    Route::delete('/teacher/chapter/delete/{chapter}', [ChapterController::class, 'delete'])->name('teacher.chapter.delete');
    Route::put('/teacher/chapter/publish/{chapter}', [ChapterController::class, 'publish'])->name('teacher.chapter.publish');
    Route::get('/teacher/analytics', [TeacherController::class, 'analytics'])->name('teacher.analytics');
    Route::get('/api/teacher/revenue', [TeacherController::class,  'revenue'])->name('api.teacher.revenue');
    Route::get('/teacher/balance', [TeacherController::class, 'balance'])->name('teacher.balance');
    Route::post('/transaction/withdraw', [TransactionController::class, 'withdraw'])->name('transaction.withdraw');
    Route::get('/teacher/voucher', [VoucherController::class, 'show'])->name('teacher.voucher');
    Route::get('/teacher/voucher/create', [VoucherController::class, 'create'])->name('teacher.voucher.create');
    Route::post('/teacher/voucher/store', [VoucherController::class, 'store'])->name('teacher.voucher.store');
    Route::get('/teacher/voucher/{id}/edit', [VoucherController::class, 'edit'])->name('teacher.voucher.edit');
    Route::put('/teacher/voucher/{id}/update', [VoucherController::class, 'update'])->name('teacher.voucher.update');
    Route::delete('/teacher/voucher/{id}/delete', [VoucherController::class, 'destroy'])->name('teacher.voucher.delete');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::post('/admin/approvewithdrawal', [AdminController::class, 'approvewithdrawal'])->name('admin.approvewithdrawal');

Route::get('/courses/{slug}/chapter/{chapter}', [CourseController::class, 'show']);

Route::get('/student/purchases', [StudentController::class, 'showActivity']);

Route::get('/payment/done', [PaymentController::class, 'done']);

Route::get('/courses/chapter-free', function () {
    return view('courses.chapter', [
        'isFree' => true,
        'isLocked' => false,
        'title' => 'Fullstack Saas Laravel',
    ]);
});

Route::put('/chapter/{chapter}/complete', [ChapterController::class, 'finish'])->name('chapter.complete');

Route::get('/courses/chapter-lock', function () {
    return view('courses.chapter', [
        'isFree' => false,
        'isLocked' => true,
        'title' => 'Fullstack Saas Laravel',
    ]);
});

Route::put('/teacher/chapter/updateorders', [ChapterController::class, 'updateorders']);

require __DIR__.'/auth.php';
