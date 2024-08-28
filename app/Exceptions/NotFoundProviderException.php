<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


class NotFoundProviderException extends Exception
{

    protected $providerName;

    /**
     * Create a new not found provider exception
     *
     * @param  string  $message
     * @param  string  $providerName
     * @return void
     */
    public function __construct(string $message, string $providerName)
    {
        $this->setProviderName($providerName);
        parent::__construct($message, Response::HTTP_NOT_FOUND);
    }

    private function setProviderName(string $providerName)
    {
        $this->providerName = $providerName;
    }

    public function render($request): JsonResponse
    {
        return response()->json([
            'error' => 'Not found',
            'provider' => $this->providerName,
            'message' => $this->getMessage(),
        ], $this->getCode() ?: Response::HTTP_NOT_FOUND);
    }
}
