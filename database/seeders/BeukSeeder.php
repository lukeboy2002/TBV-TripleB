<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class BeukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beuk = User::factory()
            ->create([
                'username' => 'beuk',
                'name' => 'Corne Donders',
                'email' => 'beuk@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('beukbeuk'),
                'remember_token' => Str::random(10),
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $beuk->roles()->attach($role);

        $beuk = Profile::factory()
            ->create([
                'user_id' => $beuk->id,
                'image_path' => 'members/Beuk.png',
                'city' => 'Tilburg',
                'biography' => '',
            ]);
    }
}
