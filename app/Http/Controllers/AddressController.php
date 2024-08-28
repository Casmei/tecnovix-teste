<?php

namespace App\Http\Controllers;

use App\Models\Address;
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

    public function findByCep(Request $request)
    {
        $query = $request->input('cep');
        $address = $this->addressService->findAddressByCep($query);

        return response()->json($address);
    }
}
