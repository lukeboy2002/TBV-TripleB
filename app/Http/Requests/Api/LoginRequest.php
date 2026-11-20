<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            // Naam van het toestel, bijv. "iPhone van Antoine". Zo zie je later welke tokens bij welke telefoon horen.
            'device_name' => ['required', 'string', 'max:255'],
        ];
    }
}
