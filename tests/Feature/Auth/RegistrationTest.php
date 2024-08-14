<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        $this->withExceptionHandling();

        $data = [
            'name' => 'Test User',
            'last_name' => 'Ocampo',
            'email' => 'test@ocampo.mx',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post(route('register'), $data);

        $response->assertRedirect();

    }
}
