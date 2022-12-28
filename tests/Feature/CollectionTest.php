<?php

namespace Tests\Feature;

use App\Models\Collection;
use App\Models\Role;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CollectionTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_collectee_user_can_request_for_collection()
    {
        $role_collectee = Role::create([
            'role' => Role::COLLECTEE
        ]);
        // Register User
        $user = $role_collectee->users()->create([
            'phone_number' => $this->faker()->numberBetween(10000,1000000),
            'password' => 'password'
        ]);
        
        $service = Service::factory()->create();

        $response = $this->post("api/v1/collections", [
            'user_id' => $user->id,
            'collection_code' => $this->faker()->word(),
            'service_id' => $service->id
        ]);

        $response->assertStatus(201);
    }

    public function test_collectors_can_view_collections()
    {
        $response = $this->get('api/v1/collections/view');

        $response->assertStatus(200);
    }
}
