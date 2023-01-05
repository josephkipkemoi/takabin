<?php

namespace Tests\Feature\Auth;

use App\Models\Role;
use App\Models\Service;
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
    public function test_can_register_user_as_collectee()
    {
        $role = Role::where('role', Role::COLLECTEE)->get()->first();

        $response = $this->post("api/v1/register", [
            'phone_number' => $this->faker()->numberBetween(1000,10000),
            'password' => 'password',
            'confirm_password' => 'password',
            'role_id' => $role->id
        ]);

        $response->assertStatus(200);
    }

    public function test_can_register_user_as_collector()
    {
        $role = Role::where('role', Role::COLLECTOR)->get()->first();
        $service_id = Service::factory()->create()->id;

        $response = $this->post("api/v1/register/collector", [
            'phone_number' => $this->faker()->numberBetween(1000,10000),
            'password' => 'password',
            'confirm_password' => 'password',
            'role_id' => $role->id,
            'service_id' => $service_id
        ]);

        $response->assertStatus(200);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create();

        $user->roles()->create([
            'role' => $this->faker()->word()
        ]);

        $response = $this->post('api/v1/login?remember=true', [
            'phone_number' => $user->phone_number,
            'password' => 'password',
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
