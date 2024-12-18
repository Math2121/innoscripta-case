<?php

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
test('Get articles', function () {
    $user = User::factory()->create([
        'email' => 'test74174471@example.com',
        'password' => bcrypt('password123'),
    ]);
    Article::factory()->create();

    $response = $this->actingAs($user)->getJson("/api/article/");

    $response->assertStatus(200);
    $response->assertJsonIsObject();
});


test('Get one article', function () {
    $user = User::factory()->create([
        'email' => 'test71841@example.com',
        'password' => bcrypt('password123'),
    ]);
    Article::factory()->create([
        'title' => "teste",
        'source' => "localhost",
        'category' => "ai",
        'date' => now(),
        'url' => "http://example.com",
        "id" => 999999
    ]);

    $response = $this->actingAs($user)->getJson("/api/article/999999");

    $response->assertStatus(200);
    $response->assertJsonIsObject();
    $response->assertJson([ "data" => ['title' => "teste",
        'source' => "localhost",
        'category' => "ai",
        'date' => now(),
        'url' => "http://example.com",
        "id" => 999999
    ]]);
});
