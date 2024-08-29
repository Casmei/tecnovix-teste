<?php

namespace App\View\Components;

use App\Models\Book;
use Illuminate\View\Component;

class BookCard extends Component
{
    public Book $book;
    public bool $limitDescription;

    /**
     * Create a new component instance.
     *
     * @param  Book  $book
     * @param  bool  $limitDescription
     * @return void
     */
    public function __construct(Book $book, $limitDescription = true)
    {
        $this->book = $book;
        $this->limitDescription = $limitDescription;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.book-card');
    }
}
