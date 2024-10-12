<?php

namespace Database\Seeders;

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
                'email' => 'beuk@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('beukbeuk'),
                'remember_token' => Str::random(10),
                'image' => 'members/Beuk.png',
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $beuk->roles()->attach($role);
    }
}
