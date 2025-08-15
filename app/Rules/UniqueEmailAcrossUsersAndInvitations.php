<?php

namespace App\Rules;

use Closure;
use DB;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class UniqueEmailAcrossUsersAndInvitations implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $emailExists = DB::table('users')->where('email', $value)->exists()
            || DB::table('invitations')->where('email', $value)->exists();

        if ($emailExists) {
            $fail('The email address has already been used.');
        }

    }
}
