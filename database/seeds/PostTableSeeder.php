<?php

use Illuminate\Database\Seeder;
use App\Post;
class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 20)
            ->create()
            ->each(function($post) {
                factory(App\Comment::class, 5)->create([
                    'post_id' => $post->id,
                ]);
            });
    }
}
