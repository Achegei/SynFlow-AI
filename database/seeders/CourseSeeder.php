<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Episode;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the "Start Here" course
        $course1 = Course::create([
            'title' => 'Start Here',
            'description' => 'Begin your journey to creating a profitable and scalable AI business here.',
            'image_url' => 'https://placehold.co/600x400/2563EB/ffffff?text=AI+Business',
        ]);

        // Create episodes for the first course
        $course1->episodes()->createMany([
            ['title' => 'Welcome! (MUST WATCH)', 'video_url' => 'https://example.com/videos/start_here_ep1'],
            ['title' => 'Building Morningside (My AAA)', 'video_url' => 'https://example.com/videos/start_here_ep2'],
        ]);

        // Create the "Building Morningside" course
        $course2 = Course::create([
            'title' => 'Building Morningside',
            'description' => 'A behind-the-scenes look at building a successful AI product from scratch.',
            'image_url' => 'https://placehold.co/600x400/9333ea/ffffff?text=AI+Product',
        ]);

        // Create episodes for the second course
        $course2->episodes()->createMany([
            ['title' => 'Building Morningside EP1: Cape Town', 'video_url' => 'https://example.com/videos/morningside_ep1'],
            ['title' => 'Building Morningside EP2: Serbia', 'video_url' => 'https://example.com/videos/morningside_ep2'],
            ['title' => 'Building Morningside EP3: Back to NZ', 'video_url' => 'https://example.com/videos/morningside_ep3'],
            ['title' => 'Building Morningside EP4: New Zealand', 'video_url' => 'https://example.com/videos/morningside_ep4'],
        ]);
    }
}
