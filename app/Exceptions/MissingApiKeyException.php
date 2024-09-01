<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MissingApiKeyException extends Exception
{
    protected $providerName;

    /**
     * Create a new missing API key exception
     *
     * @param  string  $providerName
     * @return void
     */
    public function __construct(string $providerName)
    {
        $this->setProviderName($providerName);
        parent::__construct(Response::HTTP_FORBIDDEN);
    }

    private function setProviderName(string $providerName)
    {
        $this->providerName = $providerName;
    }

    public function render($request): JsonResponse
    {
        return response()->json([
            'error' => 'Missing API Key',
            'provider' => $this->providerName,
        ], $this->getCode() ?: Response::HTTP_FORBIDDEN);
    }
}
