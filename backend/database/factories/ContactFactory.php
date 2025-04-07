<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'address' => $this->faker->streetAddress,
            'cellphone' => $this->faker->numerify('##########'),
            'email' => $this->faker->unique()->safeEmail,
            'name' => $this->faker->name,
            'neighborhood' => $this->faker->word,
            'phone' => $this->faker->numerify('##########'),
            'state' => $this->faker->state,
        ];
    }
}
