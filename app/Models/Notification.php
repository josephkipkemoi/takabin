<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    const READ_NOTIFICATIONS = 'read';
    const UNREAD_NOTIFICATIONS = 'unread';
    CONST ALL_NOTIFICATIONS = 'all';
}
