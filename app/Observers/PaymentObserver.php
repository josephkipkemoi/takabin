<?php

namespace App\Observers;

use App\Models\Collection;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\InvoicePaidNotification;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function created(Payment $payment)
    {
        //
        $collection = Collection::find($payment->collection_id);
        $collection->update([
            'payment_id' => $payment->id,
            'collected' => true,
            'collection_collected_at' => now()
        ]);

        User::find($payment->user_id)->notify(new InvoicePaidNotification($payment->payment_reference_code));
    }

    /**
     * Handle the Payment "updated" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "restored" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "force deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        //
    }
}
