<?php

namespace App\Services\External;

use App\Exceptions\MissingApiKeyException;
use App\Services\Contracts\BookProviderInterface;
use Illuminate\Support\Facades\Http;

class GoogleBookService implements BookProviderInterface
{
    protected $baseUrl;
    protected $apiKey;
    protected $providerName;


    public function __construct()
    {
        $this->baseUrl = 'https://www.googleapis.com/books/v1/volumes';
        $this->apiKey = config('services.google_books.api_key') ?? null;
        $this->providerName = 'Google Book';
    }

    public function getBookByISBN(string $isbn): ?array
    {
        if (empty($this->apiKey)) {
            throw new MissingApiKeyException($this->providerName);
        }

        $response = Http::get($this->baseUrl, [
            'q' => 'isbn:' . $isbn,
            'key' => $this->apiKey
        ]);

        return $response->json()['items'][0] ?? null;
    }

    public function getProviderName(): string
    {
        return $this->providerName;
    }
}
