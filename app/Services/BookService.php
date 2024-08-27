<?php

namespace App\Services;

use App\Models\Book;
use App\Services\Contracts\BookServiceInterface;
use App\Services\Contracts\StorageServiceInterface;

class BookService implements BookServiceInterface
{
    protected $storageService;

    public function __construct(StorageServiceInterface $storageService)
    {
        $this->storageService = $storageService;
    }

    public function setStorageService(StorageServiceInterface $storageService): void
    {
        $this->storageService = $storageService;
    }

    public function getAllBooks($query = null)
    {
        $booksQuery = Book::query();

        if ($query) {
            $booksQuery->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($query) . '%'])
                ->orWhereRaw('LOWER(author) LIKE ?', ['%' . strtolower($query) . '%']);
        }

        $books = $booksQuery->get();

        return $books->map(function ($book) {
            if ($book->image_path) {
                $book->image_path = $this->storageService->getFileUrl($book->image_path);
            }
            return $book;
        });
    }

    public function getBookById(int $id)
    {
        return Book::findOrFail($id);
    }

    public function createBook(object $data)
    {
        if (isset($data->image_path)) {
            $imagePath = $this->storageService->storeFile($data->image_path, 'books/' . $data->isbn);
            $data->image_path = $imagePath;
        }

        return Book::create((array) $data);
    }

    public function updateBook(int $id, object $data)
    {
        $book = Book::findOrFail($id);
        $book->update($data);
        return $book;
    }

    public function deleteBook(int $id)
    {
        $book = Book::findOrFail($id);
        return $book->delete();
    }
}
