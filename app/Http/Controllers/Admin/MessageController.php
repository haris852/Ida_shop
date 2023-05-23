<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendMessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index(Request $request)
    {

        // get all users that auth user received message from them
        $users = User::select('id', 'name', 'avatar')
            ->where('id', '!=', auth()->id())
            ->get();

        // get all messages from user to admin that is not read
        $unreadIds = Message::select(DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->id())
            ->where('is_read', false)
            ->groupBy('from')
            ->get();

        // add an unread key to each user with the count of unread messages
        $users = $users->map(function ($user) use ($unreadIds) {
            $userUnread = $unreadIds->where('sender_id', $user->id)->first();
            $user->unread = $userUnread ? $userUnread->messages_count : 0;
            return $user;
        });

        return view('admin.message.index', [
            'users' => $users,
        ]);
    }

    public function show(Request $request, $id)
    {
        $myId = auth()->id();
        $messages = Message::where(function ($query) use ($id, $myId) {
            $query->where('from', $myId)->where('to', $id);
        })->orWhere(function ($query) use ($id, $myId) {
            $query->where('from', $id)->where('to', $myId);
        })->get();

        return view('admin.message.components.message', [
            'messages' => $messages,
            'id' => $id,
        ])->render();
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'receiver_id' => 'required',
        ]);

        $message = Message::create([
            'from' => auth()->id(),
            'to' => $request->receiver_id,
            'message' => $request->message,
            'is_read' => false,
        ]);

        event(new SendMessageEvent($request->message, $request->receiver_id, auth()->id()));

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function read(Request $request)
    {
        Message::where('from', $request->sender_id)
            ->where('to', auth()->id())
            ->update(['is_read' => true]);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
