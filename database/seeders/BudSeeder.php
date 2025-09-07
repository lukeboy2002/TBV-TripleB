<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class BudSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bud = User::factory()
            ->create([
                'username' => 'bud',
                'name' => 'Patrick Sneller',
                'email' => 'bud@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('budbudbud'),
                'remember_token' => Str::random(10),
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $bud->roles()->attach($role);

        $bud = Profile::factory()
            ->create([
                'user_id' => $bud->id,
                'image_path' => 'members/Bud.jpg',
                'city' => 'Tilburg',
                'biography' => '',
            ]);
    }
}
