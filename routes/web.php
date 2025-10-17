<?php

use App\Http\Controllers\AcceptInvitationController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('accept-invitation/create', [AcceptInvitationController::class, 'create'])->name('accept-invitation.create')->middleware('hasInvitation');
Route::post('accept-invitation/store', [AcceptInvitationController::class, 'store'])->name('accept-invitation.store');
Route::get('team', TeamController::class)->name('team');
Route::get('games', GamesController::class)->name('games');
Route::get('posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('posts/{post:slug}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::get('posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('categories', App\Http\Controllers\Admin\CategoryController::class)->middleware('role:admin|member')->name('categories.index');
    Route::get('invitations', App\Http\Controllers\Admin\InvitationController::class)->middleware('role:admin|member')->name('invitations.index');
    Route::get('post/create', [App\Http\Controllers\Admin\PostController::class, 'create'])->middleware('role:admin|member')->name('post.create');
    Route::get('post/edit/{post:slug}', [App\Http\Controllers\Admin\PostController::class, 'edit'])->middleware('role:admin|member')->name('post.edit');
    Route::get('game/create', App\Http\Controllers\Admin\GamesController::class)->middleware('role:admin|member')->name('game.create');
    Route::post('editor/uploads/images', [App\Http\Controllers\Admin\EditorUploadController::class, 'store'])->name('editor.uploads.images');
    // TipTap editor image upload endpoint
});
