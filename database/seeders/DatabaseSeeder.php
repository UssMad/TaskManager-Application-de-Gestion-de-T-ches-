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
        User::firstOrCreate(
            ['email' => 'user@user.com'],
            [
                'name' => 'user',
                'password'=> bcrypt('admin123'),
            ]
        );

        Category::firstOrCreate(['name' => 'Travail']);
        Category::firstOrCreate(['name' => 'Personnel']);
        Category::firstOrCreate(['name' => 'Loisirs']);

        Task::factory(20)->create();
    }
}
