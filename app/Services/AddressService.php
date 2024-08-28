<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Author;
use App\Services\Contracts\AddressProviderInterface;
use App\Services\Contracts\AddressServiceInterface;


class AddressService implements AddressServiceInterface
{
    protected $addressProvider;

    public function __construct(
        AddressProviderInterface $addressProvider,
    ) {
        $this->addressProvider = $addressProvider;
    }

    public function setAddressProvider(AddressProviderInterface $addressProvider): void
    {
        $this->addressProvider = $addressProvider;
    }

    public function findAddressByCep(int $cep): Address
    {
        return $this->addressProvider->findAddressByCep($cep);
    }

    public function createAddress(object $data, Author $author): void
    {
        $addressData = (array) $data;
        $addressData['author_id'] = $author->id;

        Address::create($addressData);
    }
}
