<?php

use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('post', [PostController::class, 'index'])->name('post.index');
Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('team', [TeamController::class, 'index'])->name('team.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});

Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::post('post/upload', [\App\Http\Controllers\Admin\PostController::class, 'upload'])->name('post.upload');
    Route::resource('post', \App\Http\Controllers\Admin\PostController::class)->except('index', 'show');

    Route::get('/games', [GameController::class, 'index'])->name('games.index');
});

// Route::get('/post', function () {
//    return view('post');
// })->name('post');
Route::get('/events', function () {
    return view('events');
})->name('events');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
