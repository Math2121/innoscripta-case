<?php

use App\Models\Article;
use App\Models\User;
use App\Models\UserPreferences;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
test('Set user Preferences', function () {
    $user = User::factory()->create([
        'email' => 'test74174471@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->actingAs($user)->post("/api/preferences/", [
        "preferred_sources" => ["nba", "new york"],
        "preferred_categories" => ["ai"],
        "preferred_authors" => ["paulo", "jose"]
    ]);

    $response->assertStatus(201);
});


test('Get articles by user Preferences', function () {
    $user = User::factory()->create([
        'email' => 'teste8871@example.com',
        'password' => bcrypt('password123'),
    ]);

    UserPreferences::factory()->create([
        "user_id" => $user->id,
        "preferred_sources" => ["nba", "new york"],
        "preferred_categories" => ["ai"],
        "preferred_authors" => ["paulo", "jose"],
    ]);

    Article::factory()->create([
        'title' => "teste",
        'source' => "localhost",
        'category' => "ai",
        'date' => now(),
        'url' => "http://example.com",
        "id" => 9998
    ]);

    $response = $this->actingAs($user)->getJson("/api/preferences/");
    $response->assertStatus(200);
    $response->assertJsonIsObject();
});
