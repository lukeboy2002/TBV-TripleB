<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class RichardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $richard = User::factory()
            ->create([
                'username' => 'richard',
                'email' => 'richard@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('richardrichard'),
                'remember_token' => Str::random(10),
                'image' => 'members/Richard.jpg',
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $richard->roles()->attach($role);

    }
}
