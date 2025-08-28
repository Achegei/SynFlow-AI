<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Wins', 'Tech & Tools', 'Ask for Help', 'Business & Strategy', 'Announcements', 'YouTube Resources', 'Job Board / Hiring'];

        foreach ($categories as $category) {
            Category::factory()->create(['name' => $category]);
        }
    }
}
