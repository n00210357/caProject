<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\driver;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
            //sets what is to be filled with data when seeder is called
        return [
            'uuid' => Str::uuid(),
            'user_id' => $this->faker->randomElement([1, 2]),
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->name(),
            'certification' => $this->faker->text(),
            'photo' => $this->faker->randomElement(['P1.jpg', 'P2.jpg', 'P3.jpg']),
            'salary' => $this->faker->randomFloat(2, 0, 500),
        ];
    }
}
