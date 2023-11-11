<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function show()
    {
        $vouchers = Voucher::where('user_id', auth()->user()->id)->get();

        return view('teachers.voucher.index', [
            'vouchers' => $vouchers,
        ]);
    }

    public function create()
    {
        return view('teachers.voucher.create');

    }

    public function store(Request $request)
    {

        $voucher = [
            'code' => $request['code'],
            'discount_type' => $request['discount_type'],
            'discount' => $request['discount'],
            'expiry_date' => $request['expiry_date'],
            'user_id' => $request['user_id'],
        ];

        Voucher::create($voucher);

        return redirect(route('teacher.voucher'));

    }

    public function edit()
    {

    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
