<?php

namespace App\Services;

use App\Exceptions\NotFoundProviderException;
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

    public function findAddressByZipCode(int $zipCode): Address
    {
        $address = $this->addressProvider->findAddressByZipCode($zipCode);

        if (!$address) {
            throw new NotFoundProviderException(
                "Address with zip code {$zipCode} not found.",
                $this->addressProvider->getProviderName()
            );
        }

        return $address;
    }

    public function createAddress(object $data, Author $author): void
    {
        $addressData = (array) $data;
        $addressData['author_id'] = $author->id;

        Address::create($addressData);
    }
}
