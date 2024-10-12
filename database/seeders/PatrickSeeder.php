<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class PatrickSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patrick = User::factory()
            ->create([
                'username' => 'patrick',
                'email' => 'patrick@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('patrickpatrick'),
                'remember_token' => Str::random(10),
                'image' => 'members/Patrick.jpg',
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $patrick->roles()->attach($role);
    }
}
