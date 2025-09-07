<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'slug' => 'club-avond',
                'name' => 'Club Avond',
                'description' => 'Onze clubavond.',
            ],
            [
                'slug' => 'internationaal-toernooi',
                'name' => 'Internationaal Toernooi',
                'description' => 'Onze internationaal toernooi.',
            ],
            [
                'slug' => 'diverse',
                'name' => 'Diverse',
                'description' => 'Al het andere',
            ],
        ];

        Category::upsert($data, ['slug']);
    }
}
