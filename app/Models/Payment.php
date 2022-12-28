<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'collection_id',
        'payment_reference_code'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
