<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class BalanceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_get_user_balance()
    {
        $user = User::factory()->create();

        $response = $this->get("api/v1/users/{$user->id}/balance");

        $response->assertStatus(200);
    }

    public function test_can_update_user_balance()
    {
        $user = User::factory()->create();
        $update_amount = 300;
        $response = $this->patch("api/v1/users/{$user->id}/balance", [
            'amount' => $update_amount
        ]);

        assertEquals($user->balance->amount, $update_amount);
        $response->assertStatus(200);
    }
}