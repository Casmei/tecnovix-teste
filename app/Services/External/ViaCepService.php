<?php

namespace App\Services\External;

use App\Models\Address;
use App\Services\Contracts\AddressProviderInterface;
use Illuminate\Support\Facades\Http;

class ViaCepService implements AddressProviderInterface
{
    protected $baseUrl;
    protected $providerName;

    public function __construct()
    {
        $this->baseUrl = 'https://viacep.com.br/ws';
        $this->providerName = 'Via Cep';

    }

    public function findAddressByZipCode(int $zipCode): Address | null
    {
        $response = Http::get($this->baseUrl . '/' . $zipCode . '/json');
        $response = (object) $response->json();

        if (isset($response->erro)) {
            return null;
        }

        return $this->transformDataToEntity($response);
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

    public function getProviderName(): string
    {
        return $this->providerName;
    }
}
