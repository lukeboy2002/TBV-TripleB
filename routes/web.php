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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('categories', App\Http\Controllers\Admin\CategoryController::class)->middleware('role:admin|member')->name('categories.index');
    Route::get('invitations', App\Http\Controllers\Admin\InvitationController::class)->middleware('role:admin|member')->name('invitations.index');
    Route::post('editor/uploads/images', [App\Http\Controllers\Admin\EditorUploadController::class, 'store'])->name('editor.uploads.images');
    // TipTap editor image upload endpoint

});
