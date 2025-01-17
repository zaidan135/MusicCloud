<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlaylistController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', [MusicController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/music/upload', [MusicController::class, 'create'])->name('music.create');
Route::post('/music/store', [MusicController::class, 'store'])->name('music.store');
Route::get('/music/{id}', [MusicController::class, 'show'])->name('music.show');
Route::post('/music/{id}/like', [MusicController::class, 'like'])->name('music.like');

Route::middleware(['auth'])->group(function () {
    Route::get('/playlist', [PlaylistController::class, 'index'])->name('playlist.index');
    Route::get('/playlist/{id}', [PlaylistController::class, 'show'])->name('playlist.show');
    Route::get('/playlist/add/{id}', [PlaylistController::class, 'add'])->name('playlist.add');
    Route::get('/playlist/create', [PlaylistController::class, 'create'])->name('playlist.create');
    Route::post('/playlist/store', [PlaylistController::class, 'store'])->name('playlist.store');
});

Route::post('/playlist/add-music', [PlaylistController::class, 'addMusic'])->name('playlist.addMusic');


require __DIR__.'/auth.php';
