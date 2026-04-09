<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LogementRequest;
use App\Models\Logement;
use App\Models\LogementImage;
use Illuminate\View\View;

class LogementController extends Controller
{
    public function index()
    {
        $logements = Logement::with('images')->latest()->get();
        return view('logements.index', compact('logements'));
    }

    public function show(Logement $logement)
    {
    }

    public function myLogments()
    {
        $logements = Logement::where('user_id', auth()->id())->with('images')->latest()->get();
        return view('logements.my', compact('logements'));
    }

    public function create()
    {
        return view('logements.create');
    }

    public function store(LogementRequest $request)
    {
        $logement = Logement::create([
            'user_id' => auth()->id(),
            ...$request->validated(),
        ]);
        // php artisan storage:link
        if ($request->hasFile('images')) {
            // dd($request->hasFile('images'));
            // dd($request->file('images'));
            // dd('before image');
            foreach ($request->file('images') as $image) {
                $path = $image->store('logements', 'public');
                // LogementImage::create([
                //     'logement_id' => 3,
                //     'image_path' => 'test.jpg',
                // ]);
            //  dd($path);   
                LogementImage::create([
                    'logement_id' => $logement->id,
                    'image_path' => $path,
                ]);
                // dd('insert done');
            }
        }
        // dd($request->file('images'));
        return redirect()->back()->with('success', 'Logement created');
    }

    public function update(LogementRequest $request, Logement $logement)
    {
        $logement->update($request->validated());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('logements', 'public');
                LogementImage::create([
                    'logement_id' => $logement->id,
                    'image_path' => $path,
                ]);
            }
        }
        return redirect()->back()->with('success', 'Logement updated');
    }

    public function edit(Logement $logement)
    {
        return view('logements.edit', compact('logement'));
    }   

    public function destroy(Logement $logement)
    {
        foreach($logement->images as $image) {
            $filePath = storage_path('app/public/' . $image->image_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $image->delete();
        }
        $logement->delete();
        return redirect()->back()->with('success', 'Logement deleted');
    }
}
