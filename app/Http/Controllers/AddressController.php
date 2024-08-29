<?php

namespace App\Http\Controllers;

use App\Services\Contracts\AddressProviderInterface;
use App\Services\Contracts\AddressServiceInterface;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $addressService;

    public function __construct(
        AddressServiceInterface $addressService,
        AddressProviderInterface $addressProvider
    ) {
        $this->addressService = $addressService;
        $this->addressService->setAddressProvider = $addressProvider;
    }

    public function findByZipCode(Request $request)
    {
        $query = $request->input('zip_code');
        $address = $this->addressService->findAddressByZipCode($query);

        return response()->json($address);
    }
}
