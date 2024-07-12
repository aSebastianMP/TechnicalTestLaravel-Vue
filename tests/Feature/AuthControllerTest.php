<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase; // Reset the database after each test

    public function testLogin()
    {
        // Create a user for testing
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        // Make a POST request to the login endpoint
        $response = $this->post('http://127.0.0.1:8000/api/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // Assert the response
        $response->assertStatus(200)
            ->assertJsonStructure(['message', 'token'])
            ->assertJson(['message' => 'Success']);

        // Assert the cookie exists
        $this->assertTrue($response->headers->has('set-cookie'));
        

 }

 public function testRegister()
{
    // Create data for registration
    $userData = [
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'password' => 'password',
    ];

    // Make a POST request to the register endpoint
    $response = $this->post('http://127.0.0.1:8000/api/register', $userData);

    // Assert the response
    $response->assertStatus(201)
        ->assertJsonStructure(['message', 'user'])
        ->assertJson(['message' => 'User registered successfully']);

    // Assert the user exists in the database
    $this->assertDatabaseHas('users', [
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
    ]);
}
}
