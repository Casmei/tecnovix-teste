<?php

namespace App\Services\External;

use App\Services\Contracts\StorageServiceInterface;
use Illuminate\Support\Facades\Storage;

class S3StorageService implements StorageServiceInterface
{
    protected $disk;

    public function __construct()
    {
        $this->disk = Storage::disk('s3');
    }

    public function storeFile($file, $path): string
    {
        return $this->disk->put($path, $file);
    }

    public function deleteFile($path): bool
    {
        return $this->disk->delete($path);
    }

    public function getFileUrl(string $path): string
    {
        return $this->disk->url($path);
    }
}
