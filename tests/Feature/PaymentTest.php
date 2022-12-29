<?php

namespace Tests\Feature;

use App\Models\Payment;
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
            'role' => Role::COLLECTEE
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

        $collection->update([
            'collector_id' => 1,
            'estimate_collection_time' => '2022-12-20 17:28:29'
        ]);

        $response = $this->post("api/v1/users/$user->id/collections/$collection->id/services/$collection->service_id", [
            'user_id' => $collection->user_id,
            'service_id' => $collection->service_id,
            'collection_id' => $collection->id,
            'payment_reference_code' => $this->faker()->word()
        ]);

        $response->assertStatus(201);
    }

    public function test_can_get_user_payment_records()
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

        $payments = Payment::factory()->create([
            'user_id' => $user->id,
            'service_id' => $collection->service_id,
            'collection_id' => $collection->id,
            'payment_reference_code' => $this->faker->word()
        ]);

        $response = $this->get("api/v1/users/$user->id/payments");

        $response->assertOk();
    }
}
