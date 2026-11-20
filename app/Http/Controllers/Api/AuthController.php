<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\MeResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Inloggen vanuit de app: geeft een Sanctum-token terug dat de app veilig bewaart
     * en bij elk verzoek meestuurt als "Authorization: Bearer <token>".
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->input('email'))->first();

        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        }

        if ($user->is_banned) {
            throw ValidationException::withMessages([
                'email' => [__('Your account has been banned.')],
            ]);
        }

        if (! $user->hasAnyRole(['admin', 'member'])) {
            throw ValidationException::withMessages([
                'email' => [__('This app is only for players.')],
            ]);
        }

        $token = $user->createToken($request->input('device_name'))->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => new MeResource($user->load('profile')),
        ]);
    }

    /**
     * Uitloggen: alleen het token van dit toestel wordt ingetrokken.
     */
    public function logout(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }

    public function me(Request $request): MeResource
    {
        return new MeResource($request->user()->load('profile'));
    }
}
