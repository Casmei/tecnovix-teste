<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AddressController;

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/books');

Route::prefix('/books')->group(function () {
    Route::controller(BookController::class)->group(function () {
        Route::get('', 'list')->name('books.list');
        Route::get('/auto-complete', 'fetchBookData')->name('books.fetch');
        Route::get('/create', 'create')->name('books.create');
        Route::post('', 'store')->name('books.store');
    });
});

Route::prefix('/addresses')->group(function () {
    Route::controller(AddressController::class)->group(function () {
        Route::get('', 'findByCep')->name('address.findByCep');
    });
});
