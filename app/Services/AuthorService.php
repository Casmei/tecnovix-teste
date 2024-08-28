<?php

namespace App\Services;

use App\Models\Author;
use App\Services\Contracts\AuthorServiceInterface;


class AuthorService implements AuthorServiceInterface
{
    public function createAuthor(string $authorName): Author
    {
        return Author::firstOrCreate(['name' => $authorName], ['name' => $authorName]);
    }
}
