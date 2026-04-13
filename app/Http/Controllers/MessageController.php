<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User;
use App\Http\Requests\MessageRequest;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        $userId = auth()->id();

        $user = User::whereHas('sentMessages', function ($query) use ($userId) {
            $query->where('receiver_id', $userId);
        })->orWhereHas('receivedMessages', function ($query) use ($userId) {
            $query->where('sender_id', $userId);
        })->get();

        return view('messages.index', compact('user'));
    }

    public function show(User $user){

        $messages = Message::whereHas('sender', function ($query) use ($user) {
            $query->where('receiver_id', $user->id);
        })->orWhereHas('receiver', function ($query) use ($user) {
            $query->where('sender_id', $user->id);
        })->get();

        return view('messages.show', compact('user', 'messages'));

    }

    public function store(MessageRequest $request, User $user){
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'content' => $request->content,
        ]);

        return redirect()->route('messages.show', $user);
    }
}
