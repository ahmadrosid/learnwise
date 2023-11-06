<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class StudentController extends Controller
{
    public function showActivity()
    {
        $purchases = Transaction::select('courses.title as course_title', 'transactions.*')
            ->where('type', 'enroll')
            ->where('transactions.user_id', auth()->user()->id)
            ->join('courses', 'transactions.course_id', '=', 'courses.id')
            ->get();

        return view('students.purchases', [
            'purchases' => $purchases,
        ]);
    }
}
