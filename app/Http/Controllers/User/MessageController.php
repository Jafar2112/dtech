<?php

namespace App\Http\Controllers\User;

use App\Events\PusherBroadcast;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    private const VIEW = 'user.chat.';


    public function index($id)
    {
        $authId = Auth::id();
        $user = User::findOrFail($id);

        $chat = Chat::query()->
        where([
            'sender_id' => $id,
            'recipient_id' => $authId
        ])
            ->orWhere([
                'sender_id' => $authId,
                'recipient_id' => $id
            ])
            ->get();


        return view('user.message',compact('chat','user'));
    }

    public function store(MessageRequest $messageRequest, $id)
    {
        Chat::create([
            'message' => $messageRequest['message'],
            'sender_id' => Auth::id(),
            'recipient_id' => $id,
        ]);

        return back();
    }
}
