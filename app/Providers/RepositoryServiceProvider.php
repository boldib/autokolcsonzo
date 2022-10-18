<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Car\CarRepository;
use App\Repositories\Car\CarRepositoryInterface;
use App\Repositories\Rental\RentalRepository;
use App\Repositories\Rental\RentalRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CarRepositoryInterface::class, 
            CarRepository::class,
        );

        $this->app->bind(
            RentalRepositoryInterface::class, 
            RentalRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
