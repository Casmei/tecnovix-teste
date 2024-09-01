<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Services\Contracts\BookServiceInterface;
use App\Services\Contracts\StorageServiceInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Tecnovix me contrata ❤️",
 *     version="1.0.0",
 *     description="Documentação para listar todos os endpoints da aplicação!",
 *     @OA\Contact(
 *         email="casmei@protonmail.com",
 *         name="Tiago de Castro Lima"
 *     ),
 * )
 */
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

        flash()
            ->option('position', 'bottom-right')
            ->success('Book successfully created');

        return redirect()->route('books.list');
    }




    /**
     * @OA\Get(
     *     path="/api/books/{isbn}",
     *     summary="Get book details by ISBN",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="isbn",
     *         in="path",
     *         required=true,
     *         description="ISBN of the book",
     *         @OA\Schema(type="string", example="8525414654")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book details",
     *         @OA\JsonContent(
     *             type="object",
     *             example={
     *                 "kind": "books#volume",
     *                 "id": "9_-GPQAACAAJ",
     *                 "etag": "xSx8A5mo+mw",
     *                 "selfLink": "https://www.googleapis.com/books/v1/volumes/9_-GPQAACAAJ",
     *                 "volumeInfo": {
     *                     "title": "Misto-quente",
     *                     "authors": {"Charles Bukowski", "Pedro Gonzaga"},
     *                     "publishedDate": "2006",
     *                     "description": "Para Henry Chinaski -protagonista desta obra-...",
     *                     "industryIdentifiers": {
     *                         {"type": "ISBN_10", "identifier": "8525414654"},
     *                         {"type": "ISBN_13", "identifier": "9788525414656"}
     *                     },
     *                     "language": "pt-BR",
     *                     "pageCount": 318,
     *                     "categories": {"Alcoholics"},
     *                     "previewLink": "http://books.google.com.br/books?id=9_-GPQAACAAJ&dq=isbn:8525414654&hl=&cd=1&source=gbs_api",
     *                     "infoLink": "http://books.google.com.br/books?id=9_-GPQAACAAJ&dq=isbn:8525414654&hl=&source=gbs_api",
     *                     "canonicalVolumeLink": "https://books.google.com/books/about/Misto_quente.html?hl=&id=9_-GPQAACAAJ"
     *                 }
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found",
     *         @OA\JsonContent(
     *             type="object",
     *             example={
     *                 "error": "Not found",
     *                 "provider": "Google Book",
     *                 "message": "Book with ISBN 0005414633 not found."
     *             }
     *         )
     *     )
     * )
     */
    public function fetchBookData(Request $request)
    {
        $isbn = $request->query('isbn');
        $bookData = $this->bookService->getBookByISBN($isbn);

        return response()->json($bookData);
    }


    /**
     * @OA\Get(
     *     path="/api/books/find-or-create",
     *     summary="Find or create a book by ISBN",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="isbn",
     *         in="query",
     *         required=true,
     *         description="ISBN of the book",
     *         @OA\Schema(type="string", example="8525414654")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request - ISBN is required",
     *         @OA\JsonContent(
     *             type="object",
     *             example={
     *                 "error": "ISBN is required"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="API key not found",
     *         @OA\JsonContent(
     *             type="object",
     *             example={
     *                 "error": "Missing API Key",
     *                 "provider": "Google Book"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found",
     *         @OA\JsonContent(
     *             type="object",
     *             example={
     *                 "error": "Not found",
     *                 "provider": "Google Book",
     *                 "message": "Book with ISBN 0005414633 not found."
     *             }
     *         )
     *     )
     * )
     */
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

        flash()
            ->option('position', 'bottom-right')
            ->success('Book successfully updated');

        return redirect()->route('books.list')->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        $this->bookService->deleteBook($book->id);
        flash()
            ->option('position', 'bottom-right')
            ->success('Book successfully deleted');

        return redirect()->route('books.list');
    }
}
