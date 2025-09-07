<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);

        $this->call(CategorySeeder::class);
        $categories = Category::all();
        //        $this->call(TagsSeeder::class);
        //        $tags = Tag::all();

        $members = [[
            $this->call(AdminSeeder::class),
            $this->call(AlbertSeeder::class),
            $this->call(AntoineSeeder::class),
            $this->call(BeukSeeder::class),
            $this->call(BudSeeder::class),
            $this->call(FransSeeder::class),
            $this->call(GuusSeeder::class),
            $this->call(JacSeeder::class),
            $this->call(JohanSeeder::class),
            $this->call(JohnSeeder::class),
            $this->call(PatrickSeeder::class),
            $this->call(RichardSeeder::class),
            $this->call(RolandSeeder::class),
            $this->call(RonSeeder::class),
            $this->call(Ruudseeder::class),
        ]];
        $members = User::all();
        //        foreach ($members as $member) {
        //            Invitation::factory(2)->create([
        //                'invited_by' => $member->id,
        //            ]);
        //        }

        //        $users = User::factory(10)->create();
        //        foreach ($users as $user) {
        //            $role = Role::select('id')->where('name', 'user')->first();
        //            $user->roles()->attach($role);
        //            $profile = Profile::create([
        //                'user_id' => $user->id,
        //            ]);
        //        }

        //        $posts = Post::factory(200)
        //            ->has(Comment::factory(15)->recycle([$members, $users]))
        //            ->recycle([$members, $categories])
        //            ->create();
        //        foreach ($posts as $post) {
        //            $random_tag = rand(0, 3);
        //            $tag = $tags[$random_tag];
        //            $post->tags()->attach($tag);
        //        }
        //
        //        $album = Album::factory(6)
        //            ->recycle([$members])
        //            ->create();
    }
}
