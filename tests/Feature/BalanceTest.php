<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
}