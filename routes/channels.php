<?php

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return true;
// });

// Broadcast::channel('private-user.created', function () {
//     return true;
// });

Broadcast::channel('message.{sender_id}.{receiver_id}', function ($user, $sender_id, $receiver_id) {
    return $user->id === (User::find($sender_id)->id || User::find($receiver_id)->id);
});
