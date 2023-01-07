<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Payment extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'service_id',
        'collection_id',
        'payment_reference_code',
        'amount'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
