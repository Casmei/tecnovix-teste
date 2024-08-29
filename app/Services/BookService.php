<?php

namespace App\Services;

use App\Exceptions\NotFoundProviderException;
use App\Models\Author;
use App\Models\Book;
use App\Services\Contracts\AuthorServiceInterface;
use App\Services\Contracts\BookProviderInterface;
use App\Services\Contracts\BookServiceInterface;
use App\Services\Contracts\StorageServiceInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class BookService implements BookServiceInterface
{
    protected $storageService;
    protected $bookProvider;
    protected $authorService;
    protected $addressService;

    public function __construct(
        StorageServiceInterface $storageService,
        BookProviderInterface $bookProvider,
        AuthorServiceInterface $authorService,
        AddressService $addressService
    )
    {
        $this->storageService = $storageService;
        $this->bookProvider = $bookProvider;
        $this->authorService = $authorService;
        $this->addressService = $addressService;
    }

    public function setStorageService(StorageServiceInterface $storageService): void
    {
        $this->storageService = $storageService;
    }

    public function getAllBooks($searchTerm = null, $perPage = 4)
    {
        $books = Book::search($searchTerm)
            ->latest()
            ->paginate($perPage);

        // Usando transform na coleção paginada
        $books->getCollection()->transform(function ($book) {
            $this->getImage($book);
            return $book;
        });

        return $books;
    }

    public function getBookById(int $id)
    {
        $book = Book::findOrFail($id);
        $this->getImage($book);

        return $book;
    }

    public function createBook(object $data)
    {
        $imagePath = null;

        try {
            DB::beginTransaction();

            if (isset($data->image_path)) {
                $imagePath = $this->storageService->storeFile($data->image_path, 'books/' . $data->isbn);
                $data->image_path = $imagePath;
            }

            $author = $this->authorService->createAuthor($data->author);
            $this->addressService->createAddress($data, $author);

            $bookData = (array) $data;
            $bookData['author_id'] = $author->id;

            $book = Book::create($bookData);

            DB::commit();

            return $book;
        } catch (Exception $e) {
            DB::rollBack();

            if ($imagePath) {
                $this->storageService->deleteFile($imagePath);
            }

            throw $e;
        }
    }

    public function updateBook(int $id, object $data)
    {
        $book = Book::findOrFail($id);
        $oldImagePath = $book->image_path;
        $newImagePath = null;

        try {
            DB::beginTransaction();

            if (isset($data->image_path)) {
                $newImagePath = $this->storageService->storeFile($data->image_path, 'books/' . $data->isbn);
                $data->image_path = $newImagePath;
            }

            $book->update((array) $data);

            if ($newImagePath && $oldImagePath) {
                $this->storageService->deleteFile($oldImagePath);
            }

            DB::commit();
            return $book;
        } catch (Exception $e) {
            DB::rollBack();

            if ($newImagePath) {
                $this->storageService->deleteFile($newImagePath);
            }

            throw $e;
        }
    }

    public function deleteBook(int $id)
    {
        $book = Book::findOrFail($id);
        return $book->delete();
    }

    public function getBookByISBN(string $isbn): ?array
    {
        $book = $this->bookProvider->getBookByISBN($isbn);

        if (!$book) {
            throw new NotFoundProviderException(
                "Book with ISBN {$isbn} not found.",
                $this->bookProvider->getProviderName()
            );
        }

        return $book;
    }

    private function getImage(Book $book): void
    {
        if ($book->image_path) {
            $book->image_path = $this->storageService->getFileUrl($book->image_path);
        }
    }

    public function findOrCreateByIsbn(string $isbn): array
    {
        $book = Book::where('isbn', $isbn)->first();

        if ($book) {
            return $book->toArray();
        }

        $bookData = $this->getBookByISBN($isbn);

        if (isset($bookData)) {
            $volumeInfo = $bookData['volumeInfo'];

            $book = Book::create([
                'title' => $volumeInfo['title'] ?? null,
                'description' => $volumeInfo['description'] ?? null,
                'isbn' => $isbn,
                'year_of_publication' => $volumeInfo['publishedDate'] ?? null,
                'author_id' => $this->findOrCreateAuthor($volumeInfo['authors'][0] ?? null),
                'image_path' => $volumeInfo['imageLinks']['thumbnail'] ?? null,
            ]);

            return $book->toArray();
        }

        return [];
    }

    private function findOrCreateAuthor(?string $authorName): ?int
    {
        if (!$authorName) {
            return null;
        }

        $author = $this->authorService->createAuthor($authorName);
        return $author->id;
    }
}
