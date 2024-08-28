<?php

namespace App\Services\Contracts;

interface BookProviderInterface
{
    public function searchBooks(string $query): array;
    public function getBookByISBN(string $isbn): ?array;
}
