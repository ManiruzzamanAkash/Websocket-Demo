<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;
        $notification = new Notification();
        $notification->user_id = $user->id;
        $notification->message = "New User Created named - ".$user->name;
        $notification->seen = 0;
        $notification->save();
        return $notification;
    }
}
