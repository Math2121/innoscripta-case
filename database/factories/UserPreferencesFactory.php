<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserPreferences>
 */
class UserPreferencesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {

        return [
            "user_id" => User::factory(),
            'preferred_sources' => ["lucas", "david"],
            'preferred_categories' => ["fun", "development", "general"],
            'preferred_authors' => ["lucas", "david"],
        ];
    }
}
