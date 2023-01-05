<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    //
    public function show($user_id)
    {
        $user = User::find($user_id);
        $unreadNotificationsCount = $user->unreadNotifications->count();

        return response()
                ->json([
                    'read_notifications' => $user->readNotifications,
                    'unread_notifications' => $user->unreadNotifications,
                    'unread_notifications_count' => $unreadNotificationsCount
                ]);
    }

    public function mark_all_read($user_id)
    {
        $user = User::find($user_id);

        return $user->unreadNotifications->markAsRead();
    }
}
