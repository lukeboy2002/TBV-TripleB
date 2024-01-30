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

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

});

//MEMBERS AND ADMIN
Route::prefix('admin')->name('admin.')->middleware(['auth:web', config('jetstream.auth_session'), 'verified', 'role:member|admin'])->group(function () {
    Route::get('settings', function () {
        return view('admin.dashboard');
    })->name('settings');
});

//ONLY ADMIN
Route::prefix('admin')->name('admin.')->middleware(['auth:web', config('jetstream.auth_session'), 'verified', 'role:admin'])->group(function () {
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class)->except('show', 'destroy');
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class)->except('show', 'destroy');
});
