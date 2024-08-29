<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\BookController;

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/books');

Route::prefix('/books')->group(function () {
    Route::controller(BookController::class)->group(function () {
        Route::get('', 'list')->name('books.list');
        Route::get('/create', 'create')->name('books.create');
        Route::get('/auto-complete', 'fetchBookData')->name('books.fetch');
        Route::get('/{book}', 'show')->name('books.show');
        Route::post('', 'store')->name('books.store');
    });
});


Route::prefix('/addresses')->group(function () {
    Route::controller(AddressController::class)->group(function () {
        Route::get('', 'findByZipCode')->name('address.findByZipCode');
    });
});
