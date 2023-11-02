<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;

class TransactionController extends Controller
{
    private $apiInstance;

    public function __construct()
    {
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
        $this->apiInstance = new InvoiceApi();
    }

    public function purchase(Request $request)
    {
        $params = [
            'external_id' => (string) Str::uuid(),
            'payer_email' => $request->payer_email,
            'description' => $request->description,
            'amount' => $request->amount,
            'success_redirect_url' => route('mycourse'),
        ];

        try {
            $invoice = $this->apiInstance->createInvoice($params);
            $transaction = [
                'checkout_link' => $invoice['invoice_url'],
                'status' => 'pending',
                'external_id' => '',
                'user_id' => $request['user_id'],
                'course_id' => $request['course_id'],
                'type' => 'enroll',
                'amount' => $request['amount'],
            ];

            Transaction::create($transaction);

            return view('payments.checkout', [
                'url' => $invoice['invoce_url'],
            ]);

        } catch (\Xendit\XenditSdkException $err) {
            echo 'Exception when calling InvoiceApi->createInvoice: ', $err->getMessage(), PHP_EOL;
            echo 'Full Error: ', json_encode($err->getFullError()), PHP_EOL;
        }
    }

    public function purchaseSuccessful(Request $request)
    {
        $invoice = $this->apiInstance->getInvoiceById($request->id);
        $transaction = Transaction::where('external_id', $request->external_id)->firstOrFail();

        if ($transaction->status == 'settled') {
            return response()->json(['data' => 'Payment has already been processed!']);
        }

        try {
            $transaction->update(['status' => strtolower($invoice['status'])]);

            return response()->json(['message' => 'Payment successfully createad!']);
        } catch (\Exception $err) {
            return response()->json(['Error' => $err]);
        }
    }

    public function withdraw(Request $request)
    {
        $transaction = [
            'user_id' => $request['user_id'],
            'amount' => $request['amount'],
            'status' => 'pending',
            'type' => 'withdraw',
        ];

        Transaction::create($transaction);

        return redirect()->back();
    }

    public function refund(Request $request)
    {
        $transaction = [
            'user_id' => $request['user_id'],
            'amount' => $request['amount'],
            'status' => 'pending',
            'type' => 'refund',
        ];

        Transaction::create($transaction);

        return redirect()->back();

    }
}
