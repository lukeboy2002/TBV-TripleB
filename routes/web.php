<?php

use App\Http\Controllers\AcceptInvitationController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\App as AppFacade;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::middleware('setLocale')->group(function () {
    Route::get('/language/{locale}', function ($locale) {
        if (! in_array($locale, ['nl', 'en'])) {
            abort(400);
        }

        Session::put('locale', $locale);
        AppFacade::setLocale($locale);

        return Redirect::back();
    })->name('language.switch');

    Route::passkeys();

    Route::get('/', function () {
        return view('home');
    })->name('home');

    // Page shown to banned users when attempting to log in
    Route::get('/banned', function () {
        return view('auth.banned');
    })->name('banned');

    Route::get('accept-invitation/create', [AcceptInvitationController::class, 'create'])->name('accept-invitation.create')->middleware('hasInvitation');
    Route::post('accept-invitation/store', [AcceptInvitationController::class, 'store'])->name('accept-invitation.store');
    Route::get('team', TeamController::class)->name('team');
    Route::get('games', GamesController::class)->name('games');
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

    Route::get('posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');

    // Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::middleware(['auth', config('jetstream.auth_session'), 'verified'])->group(function () {
        Route::get('roles', [App\Http\Controllers\Admin\RolesController::class, 'index'])->middleware('role:admin')->name('roles.index');
        Route::get('roles/create', [App\Http\Controllers\Admin\RolesController::class, 'create'])->middleware('role:admin')->name('roles.create');
        Route::get('roles/{role}/edit', [App\Http\Controllers\Admin\RolesController::class, 'edit'])->middleware('role:admin')->name('roles.edit');
        Route::get('users', [App\Http\Controllers\Admin\UserRolesController::class, 'index'])->middleware('role:admin')->name('users.index');
        Route::get('users/{user:username}/edit', [App\Http\Controllers\Admin\UserRolesController::class, 'edit'])->middleware('role:admin')->name('users.edit');
        Route::get('categories', App\Http\Controllers\Admin\CategoryController::class)->middleware('role:admin|member')->name('categories.index');
        Route::get('invitations', App\Http\Controllers\Admin\InvitationController::class)->middleware('role:admin|member')->name('invitations.index');
        Route::get('post/create', [App\Http\Controllers\Admin\PostController::class, 'create'])->middleware('role:admin|member')->name('post.create');
        Route::get('post/{post:slug}/edit', [App\Http\Controllers\Admin\PostController::class, 'edit'])->middleware('role:admin|member')->name('post.edit');
        Route::get('game/create', App\Http\Controllers\Admin\GamesController::class)->middleware('role:admin|member')->name('game.create');
        Route::post('editor/uploads/images', [App\Http\Controllers\Admin\EditorUploadController::class, 'store'])->name('editor.uploads.images');
        // TipTap editor image upload endpoint
    });
});
