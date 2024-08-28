<?php

namespace App\Services\Contracts;

use App\Models\Author;

interface AuthorServiceInterface
{
    public function createAuthor(string $authorName): Author;
}
