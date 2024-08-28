<?php

namespace App\Services\Contracts;

use App\Models\Address;

interface AddressProviderInterface
{
    public function findAddressByZipCode(int $cep): Address | null;
    public function getProviderName(): string;
}
