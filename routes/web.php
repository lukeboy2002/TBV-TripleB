<?php

use App\Http\Controllers\FilepondController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', HomeController::class)->name('home');
Route::get('/team', TeamController::class)->name('team');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('games', GameController::class);

    Route::post('filepondupload', [FilepondController::class, 'upload'])->name('filepond.upload');
    Route::delete('filepondrevert', [FilepondController::class, 'revert'])->name('filepond.revert');
});

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');
Route::get('/specials', function () {
    return view('specials');
})->name('specials');
//Route::get('/about-us', function () {
//    return view('about-us');
//})->name('about-us');
Route::get('/book', function () {
    return view('book');
})->name('book');
Route::get('/events', function () {
    return view('events');
})->name('events');
Route::get('/blog', function () {
    return view('blog');
})->name('blog');
Route::get('/shop', function () {
    return view('shop');
})->name('shop');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
