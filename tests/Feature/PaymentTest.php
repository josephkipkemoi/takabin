<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_post_payment()
    {
        $role = Role::factory()->create([
            'role' => Role::COLLECTOR
        ]);

        $user = $role->users()->create([
            'phone_number' => $this->faker()->numberBetween(10000,1000000),
            'password' => 'password'
        ]);

        $service = Service::factory()->create();

        $collection = $user->collections()->create([
            'collection_code' => $this->faker()->word(),
            'service_id' => $service->id
        ]);

        $response = $this->post("api/v1/users/$user->id/collections/$collection->id/services/$collection->service_id", [
            'user_id' => $collection->user_id,
            'service_id' => $collection->service_id,
            'collection_id' => $collection->id,
            'payment_reference_code' => $this->faker()->word()
        ]);

        $response->assertStatus(201);
    }
}
