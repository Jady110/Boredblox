<?php

use App\Http\Controllers\GamesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

//Route::resource('games', GamesController::class);

// hier komt de url link naar andere pagina
Route::get('/games', [GamesController::class, 'index'])
    ->name('games.index');
Route::post('/games', [GamesController::class, 'store'])
    ->name('games.store');
Route::get('/games/create', [ProfileController::class, 'create'])
    ->name('games.create'); //deze moet bovenaan
Route::delete('/games/{game}', [GamesController::class, 'destroy'])
    ->name('games.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
