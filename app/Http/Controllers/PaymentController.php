<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;
use App\Models\User;

class PaymentController extends Controller
{
    //
    public function store(StorePaymentRequest $request, Payment $payment)
    {
        $service_cost = $request->input(['amount']);
        $user = User::find($request->input(['user_id']));

        $user_current_balance = $user->balance->amount;

        if($user_current_balance < $service_cost) {
            return response()
            ->json([
                'status' => 'failed',
                'message' => 'Insufficient balance, please top up to continue'
            ], 422);
        }

        $user->balance()->decrement('amount', $service_cost);
        return $payment->create($request->validated());
    }

    public function show($user_id)
    {
        return Payment::where('user_id', $user_id)->paginate(15);
    }
}
