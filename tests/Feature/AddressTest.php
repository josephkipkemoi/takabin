<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_post_address()
    {
        $user = User::factory()->create();

        $response = $this->post('api/v1/address', [
            'user_id' => $user->id,
            'county' =>  "Nairobi",
            'sub_county' => "Langata",
            'estate' => "Southlands",
            'house_number' => "223D",
        ]);

        $response->assertStatus(201);
    }
}
