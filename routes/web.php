<?php

use App\Http\Controllers\AvisController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LogementController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LogementController::class, 'home'])->name('home');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

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
        Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

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

    Route::get('/logements/{logement}', [LogementController::class, 'show'])->name('logements.show');
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });
});

require __DIR__.'/auth.php';
