<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\PlayerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API voor de TripleB-app
|--------------------------------------------------------------------------
| Alles hier krijgt automatisch het voorvoegsel /api (dus /api/login).
| De app logt in met /api/login en stuurt daarna bij elk verzoek
| "Authorization: Bearer <token>" mee (Laravel Sanctum).
*/

Route::name('api.')->group(function () {
    // Max 6 inlogpogingen per minuut, tegen wachtwoord-raden.
    Route::post('login', [AuthController::class, 'login'])
        ->middleware('throttle:6,1')
        ->name('login');

    Route::middleware(['auth:sanctum', 'api.player'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('me', [AuthController::class, 'me'])->name('me');

        Route::get('players', [PlayerController::class, 'index'])->name('players.index');

        Route::get('games', [GameController::class, 'index'])->name('games.index');
        Route::get('games/current', [GameController::class, 'current'])->name('games.current');
        Route::post('games', [GameController::class, 'store'])->name('games.store');
        Route::get('games/{game}', [GameController::class, 'show'])->whereNumber('game')->name('games.show');
        Route::post('games/{game}/eliminate', [GameController::class, 'eliminate'])->whereNumber('game')->name('games.eliminate');
        Route::post('games/{game}/cup-photo', [GameController::class, 'cupPhoto'])->whereNumber('game')->name('games.cup-photo');
        Route::get('cup-winner', [GameController::class, 'cupWinner'])->name('cup-winner');

        Route::get('events', [EventController::class, 'index'])->name('events.index');
        Route::get('events/{event:slug}', [EventController::class, 'show'])->name('events.show');
        Route::put('events/{event:slug}/attendance', [EventController::class, 'attendance'])->name('events.attendance');
    });
});
