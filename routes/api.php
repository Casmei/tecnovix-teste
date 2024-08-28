
<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AddressController;

use Illuminate\Support\Facades\Route;

Route::prefix('/books')->group(function () {
    Route::controller(BookController::class)->group(function () {
        Route::get('/auto-complete', 'fetchBookData')->name('books.fetch');
    });
});

Route::prefix('/addresses')->group(function () {
    Route::controller(AddressController::class)->group(function () {
        Route::get('', 'findByZipCode')->name('address.findByZipCode');
    });
});
