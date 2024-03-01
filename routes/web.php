<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');
Route::get('team', \App\Livewire\Team::class)->name('team');
Route::get('blog', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('blog/{post:slug}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
Route::resource('albums', \App\Http\Controllers\AlbumController::class);
Route::get('/albums/{album}/image/{image}', [\App\Http\Controllers\AlbumController::class, 'showImage'])->name('albums.image');



Route::get('accept-invitation/create', [\App\Http\Controllers\AcceptInvitationController::class, 'create'])->name('accept-invitation.create')->middleware('HasInvitation');
Route::post('accept-invitation/store', [\App\Http\Controllers\AcceptInvitationController::class, 'store'])->name('accept-invitation.store');

//REGISTERED USERS
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

});

//MEMBERS AND ADMIN
Route::prefix('admin')->name('admin.')->middleware(['auth:web', config('jetstream.auth_session'), 'verified', 'role:member|admin'])->group(function () {
    Route::get('settings', function () {
        return view('admin.dashboard');
    })->name('settings');

    Route::post('invite', [\App\Http\Controllers\Admin\InvitationController::class, 'store'])->name('invitations.store');
    Route::get('invite/create', [\App\Http\Controllers\Admin\InvitationController::class, 'create'])->name('invitations.create');
    Route::post('user', [\App\Http\Controllers\Admin\UserController::class, 'upload'])->name('users.upload');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except('show', 'destroy');
    Route::resource('albums', \App\Http\Controllers\Admin\AlbumController::class);
    Route::post('albums/{album}/upload', [\App\Http\Controllers\Admin\AlbumController::class, 'upload'])->name('albums.upload')->middleware('auth');
//    Route::get('/albums/{album}/image/{image}', [AlbumController::class, 'showImage'])->name('album.image.show');
    Route::delete('/albums/{album}/image/{image}', [\App\Http\Controllers\Admin\AlbumController::class, 'destroyImage'])->name('albums.image.destroy');

    Route::post('post', [\App\Http\Controllers\Admin\PostController::class, 'upload'])->name('posts.upload');
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class)->except('destroy');
    Route::post('filepondupload', [\App\Http\Controllers\Admin\FilepondController::class, 'upload'])->name('filepond.upload');
    Route::delete('filepondrevert', [\App\Http\Controllers\Admin\FilepondController::class, 'revert'])->name('filepond.revert');
});

//ONLY ADMIN
Route::prefix('admin')->name('admin.')->middleware(['auth:web', config('jetstream.auth_session'), 'verified', 'role:admin'])->group(function () {
    Route::post('roles/{role}/permissions', [\App\Http\Controllers\Admin\RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [\App\Http\Controllers\Admin\RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class)->except('show', 'destroy');

    Route::post('/permissions/{permission}/roles', [\App\Http\Controllers\Admin\PermissionController::class, 'assignRole'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [\App\Http\Controllers\Admin\PermissionController::class, 'removeRole'])->name('permissions.roles.revoke');
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class)->except('show', 'destroy');

    Route::get('posts/trashed', [\App\Http\Controllers\Admin\PostController::class, 'trashed'])->name('posts.trashed');
    Route::get('posts/trashed/{id}/restore', [\App\Http\Controllers\Admin\PostController::class, 'trashedRestore'])->name('posts.trashed.restore');

    Route::get('users/trashed', [\App\Http\Controllers\Admin\UserController::class, 'trashed'])->name('users.trashed');
    Route::get('users/trashed/{id}/restore', [\App\Http\Controllers\Admin\UserController::class, 'trashedRestore'])->name('users.trashed.restore');
    Route::post('users/{user}/roles', [\App\Http\Controllers\Admin\UserController::class, 'assignRole'])->name('users.roles');
    Route::delete('users/{user}/roles/{role}', [\App\Http\Controllers\Admin\UserController::class, 'removeRole'])->name('users.roles.revoke');
    Route::post('users/{user}/permissions', [\App\Http\Controllers\Admin\UserController::class, 'givePermission'])->name('users.permissions');
    Route::delete('users/{user}/permissions/{permission}', [\App\Http\Controllers\Admin\UserController::class, 'revokePermission'])->name('users.permissions.revoke');
});
