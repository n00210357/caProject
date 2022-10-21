<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\train;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class trainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    //allow user to flood database with fake info when run with seeder
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'cargo' => $this->faker->text(),
            'image' => "public\images\train_placeholde.jpg",
            'cost' => $this->faker->randomFloat(2),
            'destination' => $this->faker->randomDigitNot(2),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
