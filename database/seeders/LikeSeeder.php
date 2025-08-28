<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Like;
use App\Models\User; // Add this line
use App\Models\Post;

class LikeSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $posts = Post::all();

        // For each post, create 5-10 random likes
        $posts->each(function ($post) use ($users) {
            $likers = $users->random(rand(5, 10)); // Get a random number of users to like this post
            foreach ($likers as $user) {
                Like::factory()->create([
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                ]);
            }
        });
    }
}

