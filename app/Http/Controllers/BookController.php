<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Services\Contracts\BookServiceInterface;
use App\Services\Contracts\StorageServiceInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookServiceInterface $bookService, StorageServiceInterface $storageService)
    {
        $this->bookService = $bookService;
        $this->bookService->setStorageService($storageService);
    }

    public function list(Request $request)
    {
        $query = $request->input('query');
        $books = $this->bookService->getAllBooks($query);
        return view('welcome', ['books' => $books, 'query' => $query]);
    }

    public function create()
    {
        return view('book.create');
    }

    public function store(BookRequest $request)
    {
        $data = (object) $request->validated();
        $this->bookService->createBook($data);

        return redirect()->route('books.list');
    }

    public function fetchBookData(Request $request)
    {
        $isbn = $request->query('isbn');
        $bookData = $this->bookService->getBookByISBN($isbn);

        return response()->json($bookData);
    }

    public function findOrCreateByIsbn(Request $request)
    {
        $isbn = $request->query('isbn');
        if (!$isbn) {
            throw new HttpResponseException(
                response()->json(['error' => 'ISBN is required'], 400)
            );
        }

        $bookData = $this->bookService->findOrCreateByIsbn($isbn);

        return response()->json($bookData);
    }

    public function show(Book $book)
    {
        $book = $this->bookService->getBookById($book->id);
        return view('book.show', ['book' => $book]);
    }

    public function edit(Book $book)
    {
        $book = $this->bookService->getBookById($book->id);
        return view('book.edit', ['book' => $book]);
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = (object) $request->validated();
        $this->bookService->updateBook($book->id, $data);

        return redirect()->route('books.list')->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        $this->bookService->deleteBook($book->id);

        return redirect()->route('books.list');
    }
}
