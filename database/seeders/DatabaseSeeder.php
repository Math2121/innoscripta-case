<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use App\Models\UserPreferences;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Sanctum\Sanctum;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();
        Article::factory(5)->create();
        UserPreferences::factory(5)->create();
    }
}
