<?php

namespace App\Services\External;

use App\Models\Address;
use App\Services\Contracts\AddressProviderInterface;
use Illuminate\Support\Facades\Http;

class ViaCepService implements AddressProviderInterface
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://viacep.com.br/ws';
    }

    public function findAddressByCep(int $cep): Address
    {
        $response = Http::get($this->baseUrl . '/' . $cep . '/json');

        return $this->transformDataToEntity((object) $response->json());
    }

    private function transformDataToEntity(object $data): Address
    {
        $address = new Address();

        $address->zip_code = $data->cep;
        $address->street = $data->logradouro;
        $address->complement = $data->complemento;
        $address->unit = $data->unidade;
        $address->neighborhood = $data->bairro;
        $address->city = $data->localidade;
        $address->state = $data->uf;

        return $address;
    }
}
