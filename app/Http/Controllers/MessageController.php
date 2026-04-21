<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $users = User::whereHas('sentMessages', function ($query) use ($userId) {
            $query->where('receiver_id', $userId);
        })->orWhereHas('receivedMessages', function ($query) use ($userId) {
            $query->where('sender_id', $userId);
        })->get();

        return view('messages.index', compact('users'));
    }

    public function show(User $user)
    {
        $userId = auth()->id();

        $users = User::whereHas('sentMessages', function ($query) use ($userId) {
            $query->where('receiver_id', $userId);
        })->orWhereHas('receivedMessages', function ($query) use ($userId) {
            $query->where('sender_id', $userId);
        })->get();

        $authId = auth()->id();

        $messages = Message::where(function ($q) use ($authId, $user) {
            $q->where('sender_id', $authId)
                ->where('receiver_id', $user->id);
        })
            ->orWhere(function ($q) use ($authId, $user) {
                $q->where('sender_id', $user->id)
                    ->where('receiver_id', $authId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('messages.show', compact('user', 'users', 'messages'));
    }

    public function store(MessageRequest $request, User $user)
    {
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'contenu' => $request->contenu,
        ]);

        return redirect()->route('messages.show', $user);
    }
}
