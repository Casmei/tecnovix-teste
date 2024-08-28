<?php

namespace App\Services\Contracts;

use App\Models\Address;

interface AddressProviderInterface
{
    public function findAddressByCep(int $cep): Address;
}
