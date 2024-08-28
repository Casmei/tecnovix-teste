<?php

namespace App\Services\External;

use App\Services\Contracts\BookProviderInterface;
use Illuminate\Support\Facades\Http;

class GoogleBookService implements BookProviderInterface
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = 'https://www.googleapis.com/books/v1/volumes';
        $this->apiKey = config('services.google_books.api_key');
    }

    public function searchBooks(string $query): array
    {
        $response = Http::get($this->baseUrl, [
            'q' => $query,
            'key' => $this->apiKey
        ]);

        dd($response);

        return $response->json()['items'] ?? [];
    }

    public function getBookByISBN(string $isbn): ?array
    {
        $response = Http::get($this->baseUrl, [
            'q' => 'isbn:' . $isbn,
            'key' => $this->apiKey
        ]);

        return $response->json()['items'][0] ?? null;
    }
}
