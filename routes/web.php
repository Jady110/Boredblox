<?php

use App\Http\Controllers\GamesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// All game pages require the user to be logged in.
Route::middleware('auth')->group(function () {

    Route::get('/', [GamesController::class, 'index'])
        ->name('home');
    Route::get('/games', [GamesController::class, 'index'])
        ->name('games.index');
    Route::get('/games/create', [GamesController::class, 'create'])
        ->name('games.create');
    Route::post('/games', [GamesController::class, 'store'])
        ->name('games.store');
    Route::delete('/games/{game}', [GamesController::class, 'destroy'])
        ->name('games.destroy');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';
