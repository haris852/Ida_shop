<?php

namespace App\Http\Controllers\User;

use App\Events\SendMessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class UserMessageController extends Controller
{
    public function index()
    {
        // get all messages from user and admin (auth user)
        $messages = Message::where('from', auth()->id())
            ->orWhere('to', auth()->id())
            ->orderBy('created_at', 'asc')
            ->get();

        // get unread messages count from admin
        $unread = Message::where('from', 1)
            ->where('to', auth()->id())
            ->where('is_read', false)
            ->count();
        return view('customer.message', [
            'messages' => $messages,
            'unread' => $unread
        ]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);

        $message = Message::create([
            'from' => auth()->id(),
            'to' => User::where('role', User::ADMIN_ROLE)->first()->id,
            'message' => $request->message,
            'is_read' => false,
        ]);

        event(new SendMessageEvent($request->message, $message['to'], auth()->id()));

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function message(Request $request)
    {
        $messages = Message::where('from', $request->receiver_id)
            ->where('to', auth()->id())
            ->orWhere('from', auth()->id())
            ->where('to', $request->receiver_id)
            ->orderBy('created_at', 'asc')
            ->get();

        // update all unread messages from admin
        // Message::where('from', $request->receiver_id)
        //     ->where('to', auth()->id())
        //     ->update(['is_read' => true]);

        return view('admin.message.components.message', [
            'messages' => $messages
        ])->render();
    }
}
