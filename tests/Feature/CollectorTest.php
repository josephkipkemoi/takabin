<?php

namespace Tests\Feature;

use App\Models\Collection;
use App\Models\Role;
use App\Models\Service;
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

    public function test_collector_can_request_to_collect_garbage()
    {
        $collector = Role::create([
            'role' => Role::COLLECTOR
        ]);

        $user = Role::create([
            'role' => Role::COLLECTEE
        ]);

        $service = Service::factory()->create();

       $collector = $collector->users()->create([
            'phone_number' => $this->faker()->numberBetween(1000,10000),
            'password' => 'password'
       ]);

       $collectee = $user->users()->create([
        'phone_number' => $this->faker()->numberBetween(1000,10000),
        'password' => 'password'
       ]);

       $collection = $collectee->collections()->create([
            'collection_code' => $this->faker()->word(),
            'service_id' => $service->id
       ]);

       $response = $this->patch("api/v1/collections/{$collection->id}/patch", [
            'collector_id' => $collector->id,
            'estimate_collection_time' => '2022-12-20 17:28:29'
       ]);
       
       $response->assertOk();
    }

    public function test_collector_can_notify_user_on_garbage_collection()
    {
        $collectorRole = Role::create(['role' => Role::COLLECTOR]);
        $collecteeRole = Role::create(['role' => Role::COLLECTEE]);

        $service = Service::factory()->create();

       $collectee = $collecteeRole->users()->create([
            'phone_number' => $this->faker()->numberBetween(1000,10000),
            'password' => 'password'
       ]);

       $collector = $collectorRole->users()->create([
        'phone_number' => $this->faker()->numberBetween(1000,10000),
        'password' => 'password'
        ]);

       $collection = $collectee->collections()->create([
            'collection_code' => $this->faker()->word(),
            'service_id' => $service->id
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
