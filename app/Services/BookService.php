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

    public function getAllBooks($searchTerm = null)
    {
        $booksQuery = Book::query();

        if ($searchTerm) {
            $booksQuery->where(function ($query) use ($searchTerm) {
                $query->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                    ->orWhereHas('author', function ($query) use ($searchTerm) {
                        $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
                    });
            });
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
