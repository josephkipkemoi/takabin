<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factory>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            // ''
            'county' => 'Nairobi',
            'sub_county' => $this->faker->word(),
            'estate' => $this->faker->word(),
            'house_number' => $this->faker->numberBetween(10,1000)
        ];
    }
}
