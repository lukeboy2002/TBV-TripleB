<?php

namespace App\Actions\Counter;

use Illuminate\Http\Request;

class ViewCounter
{
    public static function visitorKey(Request $request): string
    {
        if ($request->user()) {
            return 'user:'.$request->user()->getAuthIdentifier();
        }

        // For guests, use a combination that’s reasonably stable for the session.
        // Session ID + IP + UA (the session ID changes when the session rotates).
        $parts = [
            $request->session()->getId(),
            $request->ip(),
            substr((string) $request->header('User-Agent'), 0, 120),
        ];

        return 'guest:'.sha1(implode('|', $parts));
    }
}
