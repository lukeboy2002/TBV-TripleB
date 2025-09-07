<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class Ruudseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ruud = User::factory()
            ->create([
                'username' => 'ruud',
                'name' => 'Ruud Slegers',
                'email' => 'ruud@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('ruudruud'),
                'remember_token' => Str::random(10),
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $ruud->roles()->attach($role);

        $ruud = Profile::factory()
            ->create([
                'user_id' => $ruud->id,
                'image_path' => 'members/Ruud.jpg',
                'city' => 'Berkel-Enschot',
                'biography' => '',
            ]);
    }
}
