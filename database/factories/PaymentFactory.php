<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::factory()->create();
        $service = Service::factory()->create();

        $collection = $user->collections()->create([
            'collection_code' => $this->faker->word(),
            'service_id' => $service->id
        ]);

        return [
            //
            'user_id' => $user->id,
            'service_id' => $collection->service_id,
            'collection_id' => $collection->id,
            'payment_reference_code' => $this->faker->word(),
            'amount' => $this->faker->numberBetween(100,500)
        ];
    }
}
