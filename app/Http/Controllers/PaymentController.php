<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;

class PaymentController extends Controller
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
        ];

        try {
            $invoice = $this->apiInstance->createInvoice($params);

            // Save to database
            $payment = [
                'checkout_link' => $invoice['invoice_url'],
                'status' => 'pending',
                'external_id' => $params['external_id'],
            ];

            Payment::create($payment);

            // return redirect($invoice['invoice_url']);
            return view('payments.checkout', [
                'url' => $invoice['invoice_url'],
            ]);

        } catch (\Xendit\XenditSdkException $err) {
            echo 'Exception when calling InvoiceApi->createInvoice: ', $err->getMessage(), PHP_EOL;
            echo 'Full Error: ', json_encode($err->getFullError()), PHP_EOL;

        }
    }

    public function successful(Request $request)
    {
        $invoice = $this->apiInstance->getInvoiceById($request->id);

        // Get data
        $payment = Payment::where('external_id', $request->external_id)->firstOrFail();

        if ($payment->status == 'settled') {
            return response()->json(['data' => 'Payment has been already processed']);
        }

        // Update status payment
        $payment->update(['status' => strtolower($invoice['status'])]);

        return view('payments.successful');

    }

    public function done()
    {

        return view('payments.successful');
    }
}
