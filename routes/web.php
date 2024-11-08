<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/team', function () {
    return view('about-us');
})->name('team');
Route::get('/game', function () {
    return view('game');
})->name('game');
Route::get('/blog', function () {
    return view('blog');
})->name('blog');
Route::get('/event', function () {
    return view('event');
})->name('event');
Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');
