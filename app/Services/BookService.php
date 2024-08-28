<?php

namespace App\Services;

use App\Exceptions\BookNotFoundException;
use App\Models\Book;
use App\Services\Contracts\AuthorServiceInterface;
use App\Services\Contracts\BookProviderInterface;
use App\Services\Contracts\BookServiceInterface;
use App\Services\Contracts\StorageServiceInterface;

class BookService implements BookServiceInterface
{
    protected $storageService;
    protected $bookProvider;
    protected $authorService;


    public function __construct(
        StorageServiceInterface $storageService,
        BookProviderInterface $bookProvider,
        AuthorServiceInterface $authorService
    )
    {
        $this->storageService = $storageService;
        $this->bookProvider = $bookProvider;
        $this->authorService = $authorService;

    }

    public function setStorageService(StorageServiceInterface $storageService): void
    {
        $this->storageService = $storageService;
    }

    public function getAllBooks($searchTerm = null)
    {
        $books = Book::search($searchTerm)->latest()->get();

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

        $author = $this->authorService->createAuthor($data->author);

        $bookData = (array) $data;
        $bookData['author_id'] = $author->id;

        return Book::create($bookData);
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

    public function searchBooks(string $query): array
    {
        return $this->bookProvider->searchBooks($query);
    }

    public function getBookByISBN(string $isbn): ?array
    {
        $book = $this->bookProvider->getBookByISBN($isbn);

        if (!$book) {
            throw new BookNotFoundException("Book with ISBN {$isbn} not found.");
        }

        return $book;
    }
}
