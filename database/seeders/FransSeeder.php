<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class FransSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $frans = User::factory()
            ->create([
                'username' => 'frans',
                'name' => 'Frans van Kempen',
                'email' => 'frans@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('fransfrans'),
                'remember_token' => Str::random(10),
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $frans->roles()->attach($role);

        $frans = Profile::factory()
            ->create([
                'user_id' => $frans->id,
                'image_path' => 'members/Frans.png',
                'city' => 'Tilburg',
                'biography' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et sagittis ipsum, et sodales ligula. Morbi ac ex erat. Curabitur imperdiet non quam vel mattis. In ut sollicitudin dui, sit amet egestas nunc. Fusce vitae aliquam odio. Donec vel ipsum vehicula, egestas diam posuere, maximus mi. Proin at est risus. Nullam eget urna ut odio lacinia venenatis. Donec nec lorem pharetra, lobortis tellus et, iaculis neque. Aliquam facilisis odio est, vitae pretium urna tempor id. Nunc viverra risus at nisi hendrerit, vitae accumsan lacus imperdiet. In at consectetur justo, ut molestie tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.',
            ]);
    }
}
