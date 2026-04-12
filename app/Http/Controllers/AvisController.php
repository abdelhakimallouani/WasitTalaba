<?php

namespace App\Http\Controllers;
use App\Models\Avis;
use App\Models\Logement;
use App\Http\Requests\AvisRequest;

use Illuminate\Http\Request;

class AvisController extends Controller
{
    public function store(AvisRequest $request, Logement $logement)
    {
        Avis::create([
            'user_id' => auth()->id(),
            'logement_id' => $logement->id,
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);
        return redirect()->route('logements.show', $logement);
    }
}
