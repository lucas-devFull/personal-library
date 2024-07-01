<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\LibraryRepository;
use App\Interface\LibraryRepositoryInterface;
use App\Services\LibraryService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LibraryRepositoryInterface::class, LibraryRepository::class);
        $this->app->bind(LibraryService::class, function($app){
            return new LibraryService($app->make(LibraryRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
