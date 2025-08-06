<?php

use App\Http\Controllers\GamesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/team', TeamController::class)->name('team.index');
Route::get('/games', GamesController::class)->name('games.index');

Route::get('post', [PostController::class, 'index'])->name('post.index');
Route::get('post/{post:slug}', [PostController::class, 'show'])->name('post.show');

Route::get('/photos', function () {
    return view('pages.photos');
})->name('photos');
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::post('post/upload', [\App\Http\Controllers\Admin\PostController::class, 'upload'])->name('post.upload');
    Route::resource('posts', App\Http\Controllers\Admin\PostController::class)->except('index', 'show', 'destroy');
});
