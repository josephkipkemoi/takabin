<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Collection extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'collection_code',
        'collector_id',
        'service_id',
        'collected',
        'payment_id',
        'estimate_collection_time',
        'collection_collected_at'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
