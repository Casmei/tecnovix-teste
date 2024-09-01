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

    /**
     * @OA\Get(
     *     path="/addresses",
     *     summary="Find address by zip code",
     *     tags={"Addresses"},
     *     @OA\Parameter(
     *         name="zip_code",
     *         in="query",
     *         required=true,
     *         description="Zip code of the address",
     *         @OA\Schema(type="integer", example=39900000)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Address details",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="zip_code", type="integer", example=12345678),
     *             @OA\Property(property="street", type="string", example="Rua Exemplo"),
     *             @OA\Property(property="complement", type="string", example="Apartamento 101"),
     *             @OA\Property(property="unit", type="string", example="Unidade 5"),
     *             @OA\Property(property="neighborhood", type="string", example="Bairro Exemplo"),
     *             @OA\Property(property="city", type="string", example="Cidade Exemplo"),
     *             @OA\Property(property="state", type="string", example="SP"),
     *             @OA\Property(property="author_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Address not found",
     *         @OA\JsonContent(
     *             type="object",
     *             example={
     *                 "error": "Not found",
     *                 "message": "Address with zip code 12345678 not found."
     *             }
     *         )
     *     )
     * )
     */
    public function findByZipCode(Request $request)
    {
        $query = $request->input('zip_code');
        $address = $this->addressService->findAddressByZipCode($query);

        return response()->json($address);
    }
}
