<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
test('Should register a user', function () {
    $response = $this->post('/api/user/register', [
        'name' => 'Test User',
        'email' => 'test585858@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('users', ['email' => 'test585858@example.com']);
});

test('failed user registration with invalid email', function () {
    $response = $this->postJson('/api/user/register', [
        'name' => 'Test User',
        'email' => 'invalid_email',
        'password' => 'password123'
    ]);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['email']);
});


test('successful user login', function () {
    $user = User::factory()->create([
        'email' => 'test74174471@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->post('/api/user/login', [
        'email' => 'test74174471@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(200);
    $this->assertArrayHasKey('token', $response->json());
});

test('successful user logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->delete('/api/user/logout');

    $response->assertStatus(204);
});
