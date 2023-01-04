<?php

namespace Tests\Feature;

use App\Models\Collection;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CollecteeTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_collectee_user_can_view_pending_collections()
    {
        $user = User::factory()->create();
        $user_2 = User::factory()->create();
        $service = Service::factory()->create();

        $user->collections()->create([
            'service_id' => $service->id,
            'collection_code' => $this->faker()->word()
        ]);

        $user->collections()->create([
            'service_id' => $service->id,
            'collection_code' => $this->faker()->word()
        ]);

        $user_2->collections()->create([
            'service_id' => $service->id,
            'collection_code' => $this->faker()->word()
        ]);

        $response = $this->get("api/v1/users/{$user->id}/collectee/collections?collected=0");

        $response->assertStatus(200);
    }
}
