<?php

namespace App\Services\Contracts;


interface BookServiceInterface
{
    public function getAllBooks();
    public function getBookById(int $id);
    public function createBook(object $data);
    public function updateBook(int $id, object $data);
    public function deleteBook(int $id);
    public function setStorageService(StorageServiceInterface $storageProvider);
}
