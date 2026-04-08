<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LogementRequest;
use App\Models\Logement;
use Illuminate\View\View;

class LogementController extends Controller
{
    public function index()
    {
        // code to list logements
    }

    public function show($id)
    {
        // code to show a single logement
    }

    public function myLogments()
    {
        // code to list logements of the authenticated owner
    }

    public function create()
    {
        return view('logements.create');
    }

    public function store(LogementRequest $request)
    {
        Logement::create([
            'user_id' => $request->user()->id,
            ...$request->validated(),
        ]);
        return redirect()->back()->with('success', 'Logement created');
    }

    public function update(LogementRequest $request, $id)
    {
        // code to update a logement
    }

    public function destroy($id)
    {
        // code to delete a logement
    }
}
