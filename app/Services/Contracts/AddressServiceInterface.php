<?php

namespace App\Services\Contracts;

use App\Models\Address;
use App\Models\Author;

interface AddressServiceInterface
{
    public function findAddressByZipCode(int $zipCode): Address;
    public function createAddress(object $address, Author $authorId): void;
}
