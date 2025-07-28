<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/team', function () {
    return view('pages.team');
})->name('team');
Route::get('/scores', function () {
    return view('pages.scores');
})->name('scores');
Route::get('/photos', function () {
    return view('pages.photos');
})->name('photos');
Route::get('/blog', function () {
    return view('pages.blog');
})->name('blog');
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
