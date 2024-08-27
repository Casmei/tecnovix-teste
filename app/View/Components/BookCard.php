<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BookCard extends Component
{
    public $book;

    /**
     * Create a new component instance.
     *
     * @param  mixed  $book
     * @return void
     */
    public function __construct($book)
    {
        $this->book = $book;
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
