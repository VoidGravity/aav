<?php

namespace Tests\Unit;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_admin_can_create_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $userData = [
            'name' => 'MyUser',
            'email' => 'admin@email.com',
            'password' => 'password',
        ];
        $email = "test@email.com";
        // Act: Make a request to the user creation endpoint
        $response = $this->actingAs($admin)->postJson('/api/users', [
            "name" => "test",
            "role" => "user",
            "email" => $email,
            "password" => "password"
        ]);

        // Assert: Check that the user was created in the database
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'name' => 'test',
            'email' => $email,
        ]);
    }

    public function test_admin_can_update_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();
        $randomEmail = "test5@email.com";
        $updatedUserData = [

            "name" => "test2",
            "role" => "user",
            "email" => $randomEmail,
            "password" => "password"

        ];

        // Act: Make a request to the user update endpoint
        $response = $this->actingAs($admin)->putJson("/api/users/{$user->id}", $updatedUserData);

        // Assert: Check that the user's data was updated in the database
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'test2',
            'email' => $randomEmail,
        ]);
    }

    public function test_admin_can_delete_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();

        // Act: Make a request to delete the user
        $response = $this->actingAs($admin)->delete("/api/users/{$user->id}");

        // Assert: Check that the user was deleted from the database
        $response->assertStatus(200);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_admin_can_get_all_users()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        // Act: Make a request to get all users
        $response = $this->actingAs($admin)->get('/api/users');

        // Assert: Check that the response contains a list of users
        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'email',
                ],
            ]);
    }

    public function test_user_can_get_all_cars()
    {
        $user = User::factory()->create();

        // Act: Make a request to get all cars
        $response = $this->actingAs($user)->get('/api/cars');

        // Assert: Check that the response contains a list of cars
        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'marque',
                    'modele',
                ],
            ]);
    }

    
    
}
