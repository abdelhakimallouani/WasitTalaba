<?php

namespace App\Http\Controllers;

use App\Models\Favori;
use App\Models\Logement;
use App\Models\Message;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $usersCount = User::count();
        $logementsCount = Logement::count();
        $messagesCount = Message::count();
        $favorisCount = Favori::count();
        $pendingCount = Reservation::where('statut', 'pending')->count();
        $acceptedCount = Reservation::where('statut', 'accepted')->count();
        $rejectedCount = Reservation::where('statut', 'rejected')->count();

        $search = $request->search;

        $users = User::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })->latest()->paginate(10);

        return view('admin.dashboard', compact(
            'usersCount',
            'logementsCount',
            'messagesCount',
            'favorisCount',
            'pendingCount',
            'acceptedCount',
            'rejectedCount',
            'users',
            'search'
        ));
    }
}
