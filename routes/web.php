<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

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
    return view('team');
})->name('team');
Route::get('/post', function () {
    return view('post');
})->name('post');
Route::get('/events', function () {
    return view('events');
})->name('events');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
