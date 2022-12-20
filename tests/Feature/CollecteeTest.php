<?php

namespace Tests\Feature;

use App\Models\Collection;
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

        Collection::create([
            'user_id' => $user->id,
            'collection_id' => $this->faker()->word()
        ]);

        Collection::create([
            'user_id' => $user->id,
            'collection_id' => $this->faker()->word()
        ]);

        Collection::create([
            'user_id' => $user_2->id,
            'collection_id' => $this->faker()->word()
        ]);

        $response = $this->get("api/v1/users/{$user->id}/collectee/collections/pending");

        $response->assertStatus(200);
    }
}
