<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this
            ->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class)
            ->post('/register', [
                'name' => 'Salwa Widfa',
                'email' => 'salwa@example.com',
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

        $response->assertRedirect('/email/verify');
        $this->assertDatabaseHas('users', [
            'email' => 'salwa@example.com',
        ]);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'password' => \Hash::make('secret123'),
            'email_verified_at' => now(),
        ]);

        $response = $this
            ->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class)
            ->post('/login', [
                'email' => $user->email,
                'password' => 'secret123',
            ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'password' => Hash::make('correct-password'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

}
