<?php

use App\Http\Controllers\AvisController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LogementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/logements/{logement}', [LogementController::class, 'show'])->name('logements.show');

    Route::middleware('role:owner')->group(function () {
        Route::get('/logements/create', [LogementController::class, 'create'])->name('logements.create');
        Route::get('/mylogements', [LogementController::class, 'myLogments'])->name('logements.my');
        Route::post('/logements', [LogementController::class, 'store'])->name('logements.store');
        Route::get('/logements/{logement}/edit', [LogementController::class, 'edit'])->name('logements.edit');
        Route::put('/logements/{logement}', [LogementController::class, 'update'])->name('logements.update');
        Route::delete('/logements/{logement}', [LogementController::class, 'destroy'])->name('logements.destroy');

        Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
        Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
        Route::patch('/reservations/{reservation}/accept', [ReservationController::class, 'accept'])->name('reservations.accept');
        Route::patch('/reservations/{reservation}/reject', [ReservationController::class, 'reject'])->name('reservations.reject');

    });
    Route::middleware('role:student')->group(function () {
        Route::get('/logements', [LogementController::class, 'index'])->name('logements.index');
        // Route::get('/logements/{logement}', [LogementController::class, 'show'])->name('logements.show');

        Route::post('/logements/{logement}/reserve', [ReservationController::class, 'store'])->name('reservations.store');
        Route::get('/favoris', [FavoriteController::class, 'index'])->name('favoris.index');
        Route::post('/favoris/{logement}', [FavoriteController::class, 'store'])->name('favoris.store');
        Route::post('/avis/{logement}', [AvisController::class, 'store'])->name('avis.store');
        Route::get('/avis/{logement}', [AvisController::class, 'index'])->name('avis.index');
    });

    Route::middleware('role:admin')->group(function () {
        // admin route
    });
});

require __DIR__.'/auth.php';
