<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    // public function markAsRead($id)
    // {
    //     $notification = auth()->user()
    //         ->notifications()
    //         ->findOrFail($id);

    //     $notification->markAsRead();

    //     return back();
    // }

    public function index()
    {
        $notifications = auth()->user()->notifications()->latest()->get();

        return view('notifications.index', compact('notifications'));
    }
}
