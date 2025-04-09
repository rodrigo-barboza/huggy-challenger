<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Models\User;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function testCannotRegisterAnUserWithoutData(): void
    {
        $this->postJson(route('auth.register'), [])
            ->assertUnprocessable();
    }

    public function testCannotRegisterAnUserWithInvalidEmail(): void
    {
        $this->postJson(route('auth.register'), [
            'name' => 'Nuno Maduro',
            'email' => 'nunomaduro',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function testCannotRegisterAnUserWithInvalidPassword(): void
    {
        $this->postJson(route('auth.register'), [
            'name' => 'Nuno Maduro',
            'email' => 'nunomaduro@example.com',
            'password' => 'pass',
            'password_confirmation' => 'pass',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['password']);
    }

    public function testCannotRegisterAnUserWithInvalidPasswordConfirmation(): void
    {
        $this->postJson(route('auth.register'), [
            'name' => 'Nuno Maduro',
            'email' => 'nunomaduro@example.com',
            'password' => 'password',
            'password_confirmation' => 'pass',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['password']);
    }

    public function testCannotRegisterAnUserWithExistingEmail(): void
    {
        User::factory()->create([
            'email' => 'nunomaduro@example.com',
        ]);

        $this->postJson(route('auth.register'), [
            'name' => 'Nuno Maduro',
            'email' => 'nunomaduro@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function testCanRegisterAnUserSuccessfully(): void
    {
        $this->postJson(route('auth.register'), [
            'name' => 'Nuno Maduro',
            'email' => 'nunomaduro@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])
            ->assertCreated()
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'name',
                    'email',
                ],
                'token',
            ])
            ->assertJsonFragment([
                'name' => 'Nuno Maduro',
                'email' => 'nunomaduro@example.com',
            ]);
    }

    public function testCannotLoginAnUserWithoutData(): void
    {
        $this->postJson(route('auth.login'), [])
            ->assertUnprocessable();
    }

    public function testCannotLoginAnUserWithInvalidData(): void
    {
        $this->postJson(route('auth.login'), [
            'email' => 'nunomaduro@example.com',
            'password' => 'password',
        ])
            ->assertUnauthorized()
            ->assertJson(['message' => 'Invalid credentials']);
    }

    public function testCanLoginAnUserSuccessfully(): void
    {
        $user = User::factory()->create([
            'name' => 'Nuno Maduro',
            'email' => 'nunomaduro@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->postJson(route('auth.login'), [
            'email' => $user->email,
            'password' => 'password',
        ])
            ->assertOk()
            ->assertJsonStructure([
                'message',
                'user' => [
                    'id',
                    'name',
                    'email',
                ],
                'token',
            ])
            ->assertJsonFragment([
                'message' => 'Authenticated',
                'name' => $user->name,
            ]);
    }
}
