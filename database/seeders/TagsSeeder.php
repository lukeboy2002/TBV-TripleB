<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Tags\Tag;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TAG MODEL
        $tag1 = Tag::create(['name' => 'Clubavond', 'slug' => 'clubavond']);
        $tag2 = Tag::create(['name' => 'Winnaar', 'slug' => 'winnaar']);
        $tag3 = Tag::create(['name' => 'Goed bezig', 'slug' => 'goed_bezig']);
        $tag4 = Tag::create(['name' => 'Gent', 'slug' => 'gent']);
    }
}
