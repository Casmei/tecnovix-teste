<?php

namespace App\Services\Contracts;

interface BookProviderInterface
{
    public function getBookByISBN(string $isbn): ?array;
    public function getProviderName(): string;
}
