<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 10; $i++) {
            $user = User::create([
                'username' => 'Test '.$i,
                'email' => 'test'.$i.'@test.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
            ]);

            //generate image
            //generate image
            $username = get_initials($user->username);
            $id = $user->id.'.png';
            $path = '/profile-photos/';
            $imagePath = create_avatar($username, $id, $path);

            //save image
            $user->profile_photo_path = $imagePath;
            $user->save();

            $role = Role::select('id')->where('name', 'user')->first();

            $user->roles()->attach($role);
        }
    }
}
