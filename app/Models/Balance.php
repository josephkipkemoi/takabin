<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    const BONUS_AMOUNT = 300;

    protected $fillable = [
        'user_id',
        'amount',
        'bonus'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
