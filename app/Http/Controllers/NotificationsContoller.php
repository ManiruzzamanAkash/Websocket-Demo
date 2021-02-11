<?php

namespace App\Http\Controllers;

use App\Events\NotificationCreated;
use App\Events\UserCreated;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NotificationsContoller extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'message' => 'required'
        ]);
        $notification = new Notification();
        $notification->user_id = $request->user_id;
        $notification->message = $request->message;
        $notification->seen = 0;
        $notification->save();
        event(new NotificationCreated($notification));
        return $notification;
    }
}
