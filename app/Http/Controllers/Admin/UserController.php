<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\user;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use PasswordValidationRules;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create:member');

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create:member');

        $this->validate($request, [
            'username' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:users',],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users',],
            'password' => $this->passwordRules(),
        ]);

        $newFilename = Str::after($request->input('image'), 'tmp/');
        Storage::disk('public')->move($request->input('image'), "members/$newFilename");

        $user = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'email_verified_at' => now(),
            'image' => "members/$newFilename",
        ]);

        $username = get_initials($user->username);
        $id = $user->id.'.png';
        $path = '/profile-photos/';
        $imagePath = create_avatar($username, $id, $path);

        //save image
        $user->profile_photo_path = $imagePath;
        $user->save();

        $role = Role::select('id')->where('name', 'member')->first();

        $user->roles()->attach($role);

        toastr()->success('new user with role member is created.', 'New User');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        //
    }
}
