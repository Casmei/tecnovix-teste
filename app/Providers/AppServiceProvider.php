<?php

namespace App\Providers;

use App\Services\AddressService;
use App\Services\BookService;
use App\Services\AuthorService;
use App\Services\Contracts\AddressProviderInterface;
use App\Services\Contracts\AddressServiceInterface;
use App\Services\Contracts\AuthorServiceInterface;
use App\Services\Contracts\BookProviderInterface;
use App\Services\Contracts\BookServiceInterface;
use App\Services\Contracts\StorageServiceInterface;
use App\Services\External\GoogleBookService;
use App\Services\External\S3StorageService;
use App\Services\External\ViaCepService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BookServiceInterface::class, BookService::class);
        $this->app->bind(AuthorServiceInterface::class, AuthorService::class);
        $this->app->bind(AddressServiceInterface::class, AddressService::class);

        $this->app->bind(StorageServiceInterface::class, S3StorageService::class);


        $this->app->bind(AddressProviderInterface::class, ViaCepService::class);
        $this->app->bind(BookProviderInterface::class, GoogleBookService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
