<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;

Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));

class PaymentController extends Controller
{
    public function purchaseCourse(Request $request)
    {
        $apiInstance = new InvoiceApi();
        $create_invoice_request = [
            'external_id' => 'test1234',
            'description' => $request['course_title'],
            'amount' => $request['price'],
            'invoice_duration' => 172800,
            'currency' => 'IDR',
            'reminder_time' => 1,
        ];

        try {
            $invoice = $apiInstance->createInvoice($create_invoice_request);

            return redirect($invoice['invoice_url']);
        } catch (\Xendit\XenditSdkException $err) {
            echo 'Exception when calling InvoiceApi->createInvoice: ', $err->getMessage(), PHP_EOL;
            echo 'Full Error: ', json_encode($err->getFullError()), PHP_EOL;
        }
    }
}
