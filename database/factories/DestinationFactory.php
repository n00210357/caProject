<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\destination>
 */
class DestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'location' => $this->faker->text,
            'station_master' => $this->faker->name,
            'picture' => $this->faker->randomElement(['T1.jpg', 'T2.jpg', 'T3.jpg']),
            'has_dock' => $this->faker->randomElement([0, 1]),
            'has_airport' => $this->faker->randomElement([0, 1]),
        ];
    }
}
