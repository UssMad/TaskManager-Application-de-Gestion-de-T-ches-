<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password'=> bcrypt('admin123'),
        
        ]);

        Category::factory()->create([
            'name' => 'Travail',
        ]);

        Category::factory()->create([
            'name' => 'Personnel',
        ]);

        Category::factory()->create([
            'name' => 'Loisirs',
        ]);

        Task::factory(20)->create();



    }
}
