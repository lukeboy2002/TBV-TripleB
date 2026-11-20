<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Laat alleen spelers (rol admin of member) die niet geblokkeerd zijn de API gebruiken.
 * Een geblokkeerde speler verliest meteen zijn token, net zoals de site hem uitlogt.
 */
class EnsureApiPlayer
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        if ((bool) ($user->is_banned ?? false)) {
            $user->currentAccessToken()?->delete();

            return response()->json(['message' => __('Your account has been banned.')], 403);
        }

        if (! $user->hasAnyRole(['admin', 'member'])) {
            return response()->json(['message' => __('This app is only for players.')], 403);
        }

        return $next($request);
    }
}
