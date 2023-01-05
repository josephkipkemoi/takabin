<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_get_user_notifications()
    {
        $role = Role::where('role', Role::COLLECTEE)->first();

        $user = $role->users()->create([
            'phone_number' => $this->faker()->numberBetween(10000,100000),
            'password' => 'password'
        ]);
        // all notifications
        // unread notifications
        //  read notifications
        $response = $this->get("api/v1/users/$user->id/notifications?status=unread");

        $response->assertStatus(200);
    }
}
