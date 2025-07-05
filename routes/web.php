<?php

use App\Http\Controllers\AcceptInvitationController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Livewire\AgendaCreate;
use App\Livewire\AgendaIndex;
use App\Livewire\AgendaShow;
use Illuminate\Support\Facades\Route;

require __DIR__.'/jetstream.php';

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('post', [PostController::class, 'index'])->name('post.index');
Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('team', [TeamController::class, 'index'])->name('team.index');

Route::get('/user/{user}', [UserController::class, 'show'])->name('profile.user');

Route::get('accept-invitation/create', [AcceptInvitationController::class, 'create'])->name('accept-invitation.create')->middleware('has.invitation');
Route::post('accept-invitation/store', [AcceptInvitationController::class, 'store'])->name('accept-invitation.store');

Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
Route::get('/albums/{album}', [AlbumController::class, 'show'])->name('albums.show');
Route::get('/albums/{album}/image/{image}', [AlbumController::class, 'showImage'])->name('album.image.show');

Route::get('/agenda', AgendaIndex::class)->name('agenda.index');
Route::get('/agenda/{agenda:slug}', AgendaShow::class)->name('agenda.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // User follow/unfollow routes
    Route::post('/user/{user}/follow', [UserController::class, 'follow'])->name('user.follow');
    Route::delete('/user/{user}/unfollow', [UserController::class, 'unfollow'])->name('user.unfollow');
    Route::get('/agenda/create/new', AgendaCreate::class)->name('agenda.create');

});

Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::post('post/upload', [\App\Http\Controllers\Admin\PostController::class, 'upload'])->name('post.upload');
    Route::resource('post', \App\Http\Controllers\Admin\PostController::class)->except('index', 'show');

    Route::get('invitations', [InvitationController::class, 'index'])->name('invitations.index');
    Route::get('invite/create', [InvitationController::class, 'create'])->name('invitations.create');
    Route::post('invite', [InvitationController::class, 'store'])->name('invitations.store');
    Route::delete('invite/{invitation}', [InvitationController::class, 'destroy'])->name('invitations.destroy');

    Route::get('/games', [GameController::class, 'index'])->name('games.index');

    Route::post('albums/{album}/upload', [\App\Http\Controllers\Admin\AlbumController::class, 'upload'])->name('albums.upload');

    Route::resource('/albums', \App\Http\Controllers\Admin\AlbumController::class)->except('index', 'show');

});

Route::get('/events', function () {
    return view('events');
})->name('events');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
