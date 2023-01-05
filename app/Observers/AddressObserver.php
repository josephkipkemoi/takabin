<?php

namespace App\Observers;

use App\Models\Address;
use App\Models\User;
use App\Notifications\AddressUpdateBonusNotification;

class AddressObserver
{
    /**
     * Handle the Address "created" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function created(Address $address)
    {
        //
        $bonus_amount = 300;
        $user = User::find($address->user_id);

        $user->balance()->update(['bonus' => $bonus_amount]);

        $user->notify(new AddressUpdateBonusNotification($bonus_amount));
    }

    /**
     * Handle the Address "updated" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function updated(Address $address)
    {
        //
    }

    /**
     * Handle the Address "deleted" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function deleted(Address $address)
    {
        //
    }

    /**
     * Handle the Address "restored" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function restored(Address $address)
    {
        //
    }

    /**
     * Handle the Address "force deleted" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function forceDeleted(Address $address)
    {
        //
    }
}
