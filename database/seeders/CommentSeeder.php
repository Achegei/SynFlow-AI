<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Add this line
use App\Models\Post;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $posts = Post::all();

        // For each post, create 3-5 random comments
        $posts->each(function ($post) use ($users) {
            Comment::factory()->count(rand(3, 5))->create([
                'post_id' => $post->id,
                'user_id' => $users->random()->id,
            ]);
        });
    }
}
