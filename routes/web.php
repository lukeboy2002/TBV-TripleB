<?php

use App\Http\Controllers\AcceptInvitationController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('accept-invitation/create', [AcceptInvitationController::class, 'create'])->name('accept-invitation.create')->middleware('hasInvitation');
Route::post('accept-invitation/store', [AcceptInvitationController::class, 'store'])->name('accept-invitation.store');

Route::get('/team', TeamController::class)->name('team.index');
Route::get('/games', GamesController::class)->name('games.index');
Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
Route::get('/albums/{album:slug}', [AlbumController::class, 'show'])->name('albums.show');
Route::get('post', [PostController::class, 'index'])->name('post.index');
Route::get('post/{post:slug}', [PostController::class, 'show'])->name('post.show');
Route::get('agendas', [AgendaController::class, 'index'])->name('agenda.index');
Route::get('agendas/{agenda:slug}', [AgendaController::class, 'show'])->name('agenda.show');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::post('post/upload', [\App\Http\Controllers\Admin\PostController::class, 'upload'])->name('post.upload');
    Route::resource('posts', App\Http\Controllers\Admin\PostController::class)->except('index', 'show', 'destroy');
    Route::post('/album/{album}/upload', [\App\Http\Controllers\Admin\AlbumController::class, 'upload'])->name('album.upload');
    Route::resource('/album', App\Http\Controllers\Admin\AlbumController::class)->except('index', 'show');
    Route::get('invitations', InvitationController::class)->name('invitations.index');
    Route::post('agenda/upload', [\App\Http\Controllers\Admin\AgendaController::class, 'upload'])->name('agenda.upload');
    Route::resource('/agenda', App\Http\Controllers\Admin\AgendaController::class)->except('index', 'show', 'destroy');
});
