<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $categories = Category::all();
        
        // Ensure users and categories exist before seeding posts
        if ($users->isEmpty() || $categories->isEmpty()) {
            return;
        }

        // Create 20 posts, each with a different random user and category
        Post::factory()->count(20)->state(function () use ($users, $categories) {
            return [
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
            ];
        })->create();
    }
}