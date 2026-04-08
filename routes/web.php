<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\LogementController;

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

    Route::middleware('role:student')->group(function () {
        Route::get('/logments',[LogementController::class,'index'])->name('logments.index');
        Route::get('/logments/{logement}',[LogementController::class,'show'])->name('logments.show');

    });

    Route::middleware('role:owner')->group(function () {
        Route::get('/mylogments',[LogementController::class,'myLogments'])->name('logments.index');
        Route::get('/logments/create',[LogementController::class,'create'])->name('logments.create');
        Route::post('/logments',[LogementController::class,'store'])->name('logments.store');
        Route::get('/logments/{logement}/edit',[LogementController::class,'edit'])->name('logments.edit');
        Route::put('/logments/{logement}',[LogementController::class,'update'])->name('logments.update');
        Route::delete('/logments/{logement}',[LogementController::class,'destroy'])->name('logments.destroy');
    });

    Route::middleware('role:admin')->group(function () {
        // admin route
    });
});


require __DIR__.'/auth.php';
