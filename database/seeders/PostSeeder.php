<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'user_id' => '1',
            'category_id' => '1',
            'title' => 'Illum nemo eum occaecati sed.',
            'slug' => 'qui-rerum-ea-quia-porro-rerum-recusandae-et-eos',
            'excerpt' => '<p>Pariatur dolor delectus dolor dolor sed suscipit. Ut voluptatem dolorem quibusdam quibusdam.</p><p>Et qui rerum ab qui quam enim. Accusamus non suscipit maxime numquam. Veniam atque vel hic voluptatum rerum. Voluptatem a similique laborum eum libero amet.</p>',
            'body' => '<p>Nihil ratione omnis reiciendis consequatur fugit a. Modi soluta fuga et alias autem neque saepe iusto. Omnis autem id minus ratione recusandae ipsam doloremque.</p><p>Sint deleniti sunt quas. Veritatis qui minus dolores ab omnis error eum. Omnis ipsum facilis voluptas excepturi. Sed consectetur voluptatem quam quia repudiandae itaque voluptatum.</p><p>Et ut ratione voluptatem quidem a officia ut deserunt. Et autem at voluptatem harum omnis vel aut. Ut aut vel dignissimos similique impedit. Perspiciatis unde porro reiciendis voluptates.</p><p>Voluptas impedit sed qui vero nulla sint. Suscipit officiis aut error adipisci sint assumenda quis. Debitis sapiente consectetur et odio. Temporibus sit assumenda itaque vel.</p><p>Ducimus eius porro est aliquid tempora et fugiat. Vero ab repellendus deserunt magni. Voluptates deleniti assumenda aut sapiente numquam.</p><p>Commodi praesentium quo odio laudantium et amet. Quis sit incidunt molestiae et maiores. Et eveniet id ipsum quas iure. Fuga qui ducimus suscipit sapiente.</p>',
            'featured_image' => '/posts-featured/1.jpeg',
            'is_published' => '1',
            'views' => '1',
        ]);

        Post::create([
            'user_id' => '2',
            'category_id' => '3',
            'title' => 'Quia tempore cumque provident velit.',
            'slug' => 'et-qui-quam-consequatur-veniam-esse',
            'excerpt' => '<p>Pariatur dolor delectus dolor dolor sed suscipit. Ut voluptatem dolorem quibusdam quibusdam.</p><p>Et qui rerum ab qui quam enim. Accusamus non suscipit maxime numquam. Veniam atque vel hic voluptatum rerum. Voluptatem a similique laborum eum libero amet.</p>',
            'body' => '<p>Nihil ratione omnis reiciendis consequatur fugit a. Modi soluta fuga et alias autem neque saepe iusto. Omnis autem id minus ratione recusandae ipsam doloremque.</p><p>Sint deleniti sunt quas. Veritatis qui minus dolores ab omnis error eum. Omnis ipsum facilis voluptas excepturi. Sed consectetur voluptatem quam quia repudiandae itaque voluptatum.</p><p>Et ut ratione voluptatem quidem a officia ut deserunt. Et autem at voluptatem harum omnis vel aut. Ut aut vel dignissimos similique impedit. Perspiciatis unde porro reiciendis voluptates.</p><p>Voluptas impedit sed qui vero nulla sint. Suscipit officiis aut error adipisci sint assumenda quis. Debitis sapiente consectetur et odio. Temporibus sit assumenda itaque vel.</p><p>Ducimus eius porro est aliquid tempora et fugiat. Vero ab repellendus deserunt magni. Voluptates deleniti assumenda aut sapiente numquam.</p><p>Commodi praesentium quo odio laudantium et amet. Quis sit incidunt molestiae et maiores. Et eveniet id ipsum quas iure. Fuga qui ducimus suscipit sapiente.</p>',
            'featured_image' => '/posts-featured/2.png',
            'is_published' => '1',
            'views' => '9',

        ]);

        Post::create([
            'user_id' => '2',
            'category_id' => '2',
            'title' => 'Atque est quo ut aspernatur necessitatibus omnis commodi asperiores.',
            'slug' => 'non-adipisci-et-rerum-corrupti-debitis-quis',
            'excerpt' => '<p>Illum doloribus molestiae expedita adipisci. Sapiente blanditiis earum nihil ex suscipit eos. Nam accusantium dolorem est cupiditate soluta.</p><p>Et ut id accusantium illo. Necessitatibus ipsum dolorem reprehenderit. Est ab est voluptas voluptas quia eum.</p>',
            'body' => '<p>Quas corporis dolores asperiores quas laboriosam reprehenderit. Quae eaque a assumenda hic sed debitis voluptas. Aliquam ad non aliquid. Repudiandae quae eligendi non sed enim id qui.</p><p>Quia ut aut doloremque exercitationem expedita. Aperiam eligendi sed eaque. Impedit molestias est id illo. Facilis aperiam in rem necessitatibus maiores maxime similique.</p><p>Quod reiciendis cupiditate facere. Praesentium quia blanditiis vel reiciendis et. Neque minima et quam aut autem. Dignissimos vitae deserunt et dolorum dignissimos et ab.</p><p>Consectetur temporibus qui voluptatem enim blanditiis modi dolor. Praesentium qui facere corporis corrupti recusandae. Voluptates voluptatem ut sint beatae nihil dolores debitis.</p><p>Aut enim voluptatum qui a blanditiis id. Laboriosam maxime nulla ullam ex. Voluptate sint fugit nihil porro totam. Quia ipsam voluptas minus exercitationem quaerat. Qui sint accusantium et adipisci.</p><p>Rerum facilis accusantium adipisci excepturi deleniti ut nulla dolor. Et sint inventore reiciendis dolor qui qui dolores. Voluptatibus dolores mollitia aspernatur neque necessitatibus necessitatibus.</p>',
            'featured_image' => '/posts-featured/3.jpeg',
            'is_published' => '1',
            'views' => '3',
        ]);
    }
}
