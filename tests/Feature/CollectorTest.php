<?php

namespace Tests\Feature;

use App\Models\Collection;
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

    public function test_collector_can_request_for_garbage_collection()
    {
        $role = Role::create([
            'role' => Role::COLLECTOR
        ]);

       $collector = Role::find($role->id)->users()->create([
            'phone_number' => $this->faker()->numberBetween(1000,10000),
            'password' => 'password'
       ]);

       $collection = Collection::factory()->create();

       $response = $this->patch("api/v1/collections/{$collection->id}/patch", [
            'collector_id' => $collector->id,
            'estimate_collection_time' => '2022-12-20 17:28:29'
       ]);
       
       $response->assertOk();
    }

    public function test_collector_can_notify_user_on_garbage_collection()
    {
        $collectorRole = Role::create([
            'role' => Role::COLLECTOR
        ]);

        $collecteeRole = Role::create([
            'role' => Role::COLLECTEE
        ]);

       $collectee = Role::find($collecteeRole->id)->users()->create([
            'phone_number' => $this->faker()->numberBetween(1000,10000),
            'password' => 'password'
       ]);

       $collector = Role::find($collectorRole->id)->users()->create([
        'phone_number' => $this->faker()->numberBetween(1000,10000),
        'password' => 'password'
        ]);

       $collection = Collection::create([
            'user_id' => $collectee->id,
            'collection_id' => $this->faker()->word()
       ]);

       $this->patch("api/v1/collections/{$collection->id}/patch", [
        'collector_id' => $collector->id,
        'estimate_collection_time' => '2022-12-20 17:28:29'
       ]);

       $response = $this->patch("api/v1/collections/{$collection->id}/picked", [
            'collected' => true,
            'collection_collected_at' => '2022-12-20 17:28:29'
       ]);

       $response->assertOk();
   
    }
}
