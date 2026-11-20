<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StartGameRequest extends FormRequest
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
            'date' => ['nullable', 'date'],
            'players' => ['required', 'array', 'min:2'],
            'players.*' => ['integer', 'distinct', 'exists:users,id'],
        ];
    }
}
