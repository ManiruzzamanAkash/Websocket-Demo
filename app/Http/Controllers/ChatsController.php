<?php

namespace App\Http\Controllers;

use App\Events\MessageSendEvent;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        if (!is_null($user)) {
            $message = new Message();
            $message->sender_id = $user->id;
            $message->receiver_id = $request->receiver_id;
            $message->message = $request->message;
            $message->save();
            event(new MessageSendEvent($message));
            return response(['status' => true, 'message' => 'SMS Send', 'message' => $message]);
        }
        return response(['status' => false, 'message' => 'Un authorized to send message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
