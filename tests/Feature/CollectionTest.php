<?php

namespace Tests\Feature;

use App\Models\Collection;
use App\Models\Role;
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
        $this->post("api/v1/register?user_role={$role_collectee->id}", [
            'phone_number' => $this->faker()->numberBetween(1000,10000),
            'password' => 'password',
            'confirm_password' => 'password'
        ]);

        $response = $this->post("api/v1/collections", [
            'user_id' => 1,
            'collection_id' => $this->faker()->word(),
        ]);

        $response->assertStatus(201);
    }

    public function test_collectors_can_view_collections()
    {
        Collection::factory()->create();

        $response = $this->get('api/v1/collections/view');

        $response->assertStatus(200);
    }
}
