<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Favori;
use App\Models\Logement;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favoris = auth()->user()->favoris()->with('logement.images')->get();

        return view('favoris.index', compact('favoris'));
    }

    public function store($logementId)
    {
        $user = Auth::user();
        $favoris = Favori::where('user_id', $user->id)
            ->where('logement_id', $logementId)
            ->first();

        if ($favoris) {
            $favoris->delete();
        }else {
            Favori::create([
                'user_id' => $user->id,
                'logement_id' => $logementId,
            ]);
        }
        return back();
    }

}
