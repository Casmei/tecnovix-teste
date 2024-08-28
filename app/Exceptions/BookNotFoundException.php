<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class BookNotFoundException extends Exception
{
    /**
     * Create a new exception
     *
     * @param  string  $isbn
     * @return void
     */
    public function __construct(string $isbn)
    {
        parent::__construct("Book with ISBN {$isbn} not found.");
    }

    public function render($request): JsonResponse
    {
        return response()->json([
            'error' => 'Book not found',
            'message' => $this->getMessage(),
        ], 404);
    }
}
