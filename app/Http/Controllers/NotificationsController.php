<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    //
    public function show($user_id)
    {
        return User::find($user_id)->notifications;
    }
}
