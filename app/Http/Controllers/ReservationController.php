<?php

namespace App\Http\Controllers;
use App\Models\Logement;
use App\Models\Reservation;
use App\Models\User;


use App\Http\Requests\ReservationRequest;
use Illuminate\Http\Request;


class ReservationController extends Controller
{
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
