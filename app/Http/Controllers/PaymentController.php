<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;

class PaymentController extends Controller
{
    //
    public function store(StorePaymentRequest $request, Payment $payment)
    {
        return $payment->create($request->validated());
    }
}
