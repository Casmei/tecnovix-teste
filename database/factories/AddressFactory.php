<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition()
    {
        return [
            'zip_code' => $this->faker->postcode,
            'street' => $this->faker->streetAddress,
            'complement' => $this->faker->optional()->word,
            'unit' => $this->faker->word,
            'neighborhood' => $this->faker->word,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'author_id' => Author::factory(),
        ];
    }
}
