<?php

namespace App\Http\Controllers;
use App\Models\Logement;
use App\Models\Reservation;
use App\Models\User;


use App\Http\Requests\ReservationRequest;
use Illuminate\Http\Request;


class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::whereHas('logement', function ($query) {
            $query->where('user_id', auth()->id());
        })->with('logement', 'user')->latest()->get();

        return view('reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        $reservation->load('logement', 'user');
        return view('reservations.show', compact('reservation'));
    }
    public function accept(Reservation $reservation)
    {
        $reservation->update(['statut'=> 'accepted']);
        return redirect()->back()->with('success', 'Reservation accepted');
    }
    public function refuse(Reservation $reservation)
    {
        $reservation->update(['statut'=> 'refused']);
        return redirect()->back()->with('success', 'Reservation refused');
    }
    public function store(ReservationRequest $request, Logement $logement)
    {

        Reservation::create([
            'user_id' => auth()->id(),
            'logement_id' => $logement->id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'statut' => 'pending',
        ]);

        return redirect()->route('logements.show', $logement)->with('success', 'Bon reservation ');
    }
}
