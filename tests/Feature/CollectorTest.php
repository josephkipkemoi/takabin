<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CollectorTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_get_list_of_collectors()
    {
        $role = Role::create([
            'role' => Role::COLLECTOR
        ]);

        $this->post("api/v1/register?user_role={$role->id}", [
            'phone_number' => $this->faker()->numberBetween(1000,10000),
            'password' => 'password',
            'confirm_password' => 'password'
        ]);

        $this->post("api/v1/register?user_role={$role->id}", [
            'phone_number' => $this->faker()->numberBetween(1000,10000),
            'password' => 'password',
            'confirm_password' => 'password'
        ]);

        $response = $this->get('api/v1/collectors');
        
        $response->assertStatus(200);
    }
}
