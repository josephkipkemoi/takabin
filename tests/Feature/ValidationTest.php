<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_validate_if_user_is_registered()
    {
        $user = User::factory()->create();

        $response = $this->get("api/v1/validate?type=user&phone_number=$user->phone_number");

        $response->assertStatus(200);
    }

    public function test_can_validate_if_registered_user_has_updated_address()
    {
        $user = User::factory()->create();
        
        $response = $this->get("api/v1/validate?type=address&phone_number=$user->phone_number");

        $response->assertStatus(200);
    }
}
