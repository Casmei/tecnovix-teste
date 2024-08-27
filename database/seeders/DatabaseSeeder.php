<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Author::factory(4)->create()->each(function ($author) {
            Address::factory()->create(['author_id' => $author->id]);
            Book::factory(2)->create(['author_id' => $author->id]);
        });
    }
}
