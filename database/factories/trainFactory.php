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

    /*
    this is were seeder gets the random values when it fills the database with fake info
    uuid is filled with a random uuid
    user_id is hard coded to be user 1
    name uses faker name making it a random name
    cargo uses faker text giving it some random text
    image is hard coded with the image names and randomize between the three
    cost uses faker random float 2 which is meant to fill it with a random float with up to point two digits but it usally comes up with an out of cost bounds error that stops the seeding process but still fills in the prevously valid ones
    destination uses faker random digit not 2 which makes it a random single digit number (0, 1, 2, 3, 4, 5, 6, 7, 8, 9)
    */
    public function definition()
    {
        return [
            'uuid' => Str::uuid(),
            'user_id' => 1,
            'name' => $this->faker->name(),
            'cargo' => $this->faker->text(),
            'image' => $this->faker->randomElement(['T1.jpg', 'T2.jpg', 'T3.jpg']),
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
