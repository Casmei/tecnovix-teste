<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'author_id' => Author::factory(),
            'description' => $this->faker->paragraph(10),
            'year_of_publication' => $this->faker->year,
            'isbn' => $this->faker->isbn10,
        ];
    }
}
