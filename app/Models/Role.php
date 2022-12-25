<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // AVAILABLE ROLES
    const COLLECTOR = 'Collector';
    const COLLECTEE = 'Collectee';

    const COLLECTORID = 1;
    const COLLECTEEID = 2;
    
    protected $fillable = [
        'role'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
