<?php

namespace App\Observers;

use App\Models\Collection;
use App\Models\Role;
use App\Notifications\NewCollectionNotification;
use Illuminate\Support\Facades\Notification;

class CollectionObserver
{
    /**
     * Handle the Collection "created" event.
     *
     * @param  \App\Models\Collection  $collection
     * @return void
     */
    public function created(Collection $collection)
    {
        //
        $collectors =  Role::where('role', Role::COLLECTOR)->first()->users;
        
        Notification::send($collectors, new NewCollectionNotification($collection));
    }

    /**
     * Handle the Collection "updated" event.
     *
     * @param  \App\Models\Collection  $collection
     * @return void
     */
    public function updated(Collection $collection)
    {
        // Notify User
        // $user = $collection->user_id;
        // if($collection->collection_collected_at == null) {

        // }
    }

    /**
     * Handle the Collection "deleted" event.
     *
     * @param  \App\Models\Collection  $collection
     * @return void
     */
    public function deleted(Collection $collection)
    {
        //
    }

    /**
     * Handle the Collection "restored" event.
     *
     * @param  \App\Models\Collection  $collection
     * @return void
     */
    public function restored(Collection $collection)
    {
        //
    }

    /**
     * Handle the Collection "force deleted" event.
     *
     * @param  \App\Models\Collection  $collection
     * @return void
     */
    public function forceDeleted(Collection $collection)
    {
        //
    }
}
