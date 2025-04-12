<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Portfolio;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Portfolio::create([
            'title' => 'Creative Agency Website',
            'category' => 'web',
            'image' => 'portfolio/project1.jpg',
            'link' => '#'
        ]);
        
        Portfolio::create([
            'title' => 'Fitness Tracker App',
            'category' => 'app',
            'image' => 'portfolio/project2.jpg',
            'link' => '#'
        ]);
        
    }



// Add more projects...

}
