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
    public function index(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'receiver_id' => 'required|numeric'
        ]);

        if (is_null($user))  return response(['status' => false, 'message' => 'Un authorized to send message']);

        // $all_messages = Message::where(function($request, $query, $user) {
        //     $query->where('receiver_id', $request->receiver_id)
        //           ->orWhere('sender_id', $user->id);
        // })
        // ->where(function($request, $query, $user) {
        //     $query->where('sender_id', $request->receiver_id)
        //           ->where('receiver_id', $user->id);
        // })
        // ->orderBy('id', 'desc')
        // ->get();

        $sent_messages = Message::where('sender_id', $user->id)
            ->where('receiver_id', $request->receiver_id)
            ->orderBy('id', 'desc')
            ->get();
        $received_messages = Message::where('receiver_id', $user->id)
            ->where('sender_id', $request->receiver_id)
            ->orderBy('id', 'desc')
            ->get();

        $merged = $sent_messages->merge($received_messages);
        $messages = collect($merged->all());
        // $x = $messages->toArray();
        // usort($x, function ($v1, $v2) {
        //     return strcmp($v1['id'], $v2['id']);
        // });

        // $sorted = $messages->map(function($id) use($messagesNew) {
        //     return $messagesNew->where('id', $id)->first();
        // });

        return $messages;
    }

    public function cmp($a, $b)
    {
        return strcmp($a["id"], $b["id"]);
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
