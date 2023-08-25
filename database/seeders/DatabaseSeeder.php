<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //$this->call([''])
        Category::factory(5)->create();
        // User::factory(10)->create();
        // Task::factory(10)->create();
        // foreach (Task::all() as $task);
        // ]);
        // \App\Models\User::factory(10)->create();

        
    }
}
