<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function testCannotRegisterAnUserWithoutData(): void
    {
        $this->postJson(route('auth.register'), [])
            ->assertUnprocessable();
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
}
