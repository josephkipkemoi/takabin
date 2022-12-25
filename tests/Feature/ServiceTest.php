<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertNotContains;
use function PHPUnit\Framework\assertSame;

class ServiceTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_add_service()
    {
        $response = $this->post('api/v1/services', [
            'service' => $this->faker()->word()
        ]);

        $response->assertStatus(201);
    }

    public function test_can_get_added_services()
    {
        $services = Service::factory()->create();

        $response = $this->get('api/v1/services');

        assertSame(json_decode($response->getContent())[0]->service, $services->service);

        $response->assertOk();
    }

    public function test_can_delete_service()
    {
        $services = Service::factory()->create();

        $response = $this->delete("api/v1/services/{$services->id}");

        $response->assertOk();
    }
}
