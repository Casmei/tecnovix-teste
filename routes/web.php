<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/books');
Route::prefix('/books')->group(function () {
    Route::controller(BookController::class)->group(function () {
        Route::get('', 'list')->name('books.list');
        Route::get('/create', 'create')->name('books.create');
        Route::post('', 'store')->name('books.store');
    });
});
