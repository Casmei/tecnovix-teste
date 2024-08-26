<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'year_of_publication' => $this->faker->year,
            'image_path' => $this->faker->imageUrl(640, 480, 'books', true),
            'isbn' => $this->faker->isbn13,
        ];
    }
}
