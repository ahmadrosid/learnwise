<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        return redirect(route('admin.users'));
    }

    public function users()
    {
        $data = User::all();

        return view('admin.users', [
            'users' => $data,
        ]);
    }

    public function transactions()
    {
        $data = Transaction::all();

        return view('admin.transactions', [
            'transactions' => $data,
        ]);
    }

    public function approvewithdrawal(Request $request)
    {

        Transaction::where('id', $request['transaction_id'])->update(['status' => 'approved']);

        return redirect()->back();
    }
}
