<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

/**
 * De ingelogde speler zelf: hier mag het e-mailadres en de rol wel bij.
 *
 * @mixin \App\Models\User
 */
class MeResource extends PlayerResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),
            'email' => $this->email,
            'roles' => $this->getRoleNames(),
        ];
    }
}
