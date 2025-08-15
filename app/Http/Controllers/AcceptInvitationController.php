<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Invitation;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Role;

class AcceptInvitationController extends Controller
{
    use PasswordValidationRules;

    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);

        $user = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'name' => $request['name'],
            'invited_by' => $request['invited_by'],
            'email_verified_at' => now(),
            'password' => Hash::make($request['password']),
        ]);

        $role = Role::select('id')->where('name', 'user')->first();

        $user->roles()->attach($role);

        $invitation = Invitation::where('email', $user->email)->first();
        if ($invitation) {
            // Delete the invitation after successful registration
            $invitation->delete();
        }

        $profile = Profile::create([
            'user_id' => $user->id,
        ]);
        flash()->success('Account successfully created. You can login.');

        return redirect()->route('home');
    }

    public function create(Request $request)
    {
        $invitation_token = $request->get('invitation_token');
        $invitation = Invitation::where('invitation_token', $invitation_token)->firstOrFail();
        $email = $invitation->email;

        return view('profile.create', compact('email', 'invitation'));
    }
}
