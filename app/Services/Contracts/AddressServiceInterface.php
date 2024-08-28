<?php

namespace App\Services\Contracts;

use App\Models\Address;
use App\Models\Author;

interface AddressServiceInterface
{
    public function findAddressByCep(int $cep): Address;
    public function createAddress(object $address, Author $authorId): void;
}
