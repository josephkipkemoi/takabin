<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class BalanceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_get_user_balance()
    {
        $role = Role::where('role', Role::COLLECTEE)->first();

        $user = $role->users()->create([
            'phone_number' => $this->faker()->numberBetween(10000,100000),
            'password' => 'password'
        ]);
        
        $response = $this->get("api/v1/users/{$user->id}/balance");

        $response->assertStatus(200);
    }

    public function test_can_update_user_balance()
    {
        $role = Role::where('role', Role::COLLECTEE)->first();
        
        $user = $role->users()->create([
            'phone_number' => $this->faker()->numberBetween(10000,100000),
            'password' => 'password'
        ]);

        $update_amount = 300;

        $response = $this->patch("api/v1/users/{$user->id}/balance", [
            'amount' => $update_amount
        ]);

        assertEquals($user->balance->amount, $update_amount);
        $response->assertStatus(200);
    }
}