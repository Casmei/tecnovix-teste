<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Services\Contracts\BookServiceInterface;
use App\Services\External\S3StorageService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookServiceInterface $bookService, S3StorageService $storageService)
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
    }

    public function show(Book $book)
    {
        //
    }

    public function edit(Book $book)
    {
        //
    }

    public function update(Request $request, Book $book)
    {
        //
    }

    public function destroy(Book $book)
    {
        //
    }
}
