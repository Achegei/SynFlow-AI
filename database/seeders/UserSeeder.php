<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Creates a set number of regular users
        User::factory()->count(10)->create();

        // Creates a few special users (e.g., admins, online users, leaderboard members)
        User::factory()->create([
            'name' => 'Laban Ekitela',
            'is_online' => true,
            'is_admin' => true,
            'score' => 980,
            'profile_photo_url' => 'https://placehold.co/100x100/A5B4FC/4338CA?text=LE',
        ]);
        User::factory()->create([
            'name' => 'Maria Rodriguez',
            'is_online' => true,
            'score' => 1250,
            'profile_photo_url' => 'https://placehold.co/100x100/B2EBF2/00695C?text=MR',
        ]);
        User::factory()->create([
            'name' => 'Sarah Chen',
            'is_online' => true,
            'score' => 1120,
            'profile_photo_url' => 'https://placehold.co/100x100/A5D6A7/2B5D2F?text=SC',
        ]);
    }
}