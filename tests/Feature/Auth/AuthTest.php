<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_register_user()
    {
        $response = $this->post('api/v1/register', [
            'phone_number' => 0700545727,
            'password' => 'password',
            'confirm_password' => 'password'
        ]);

        $response->assertStatus(201);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create();

        $response = $this->post('api/v1/login', [
            'phone_number' => $user->phone_number,
            'password' => 'password'
        ]);
      
        $response->assertOk();
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $user = User::factory()->create();

        $response = $this->post('api/v1/login', [
            'phone_number' => $user->phone_number,
            'password' => 'passwords'
        ]);
      
        $response->assertStatus(302);
    }

    public function test_user_can_logout()
    {
        $response = $this->post('api/v1/logout');
      
        $response->assertStatus(204);   
    }
}
