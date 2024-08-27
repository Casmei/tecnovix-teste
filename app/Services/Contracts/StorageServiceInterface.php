<?php

namespace App\Services\Contracts;

interface StorageServiceInterface
{
    public function storeFile($file, $path): string;
    public function getFileUrl(string $path): string;
    public function deleteFile($path): bool;
}
