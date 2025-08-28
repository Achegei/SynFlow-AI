<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call all your other seeders here
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            LikeSeeder::class,
            CourseSeeder::class,
        ]);
        
        // This is a good place to create a single test user for development
        // You can use the factory as you had it.
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // Add a default password
        ]);
    }
}