<?php

namespace App\Providers;

use App\Contracts\ImportCustomerInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\RandomUserApi;

class ImportCustomerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * bind the Interface with the service class
         * this will tell which Service Provicder is being used
         * when the Import Service are being instatiated in the constructor or func arg
         * this will make an easy switch to the class if the previous is discontinued.
         *
         */
        $this->app->singleton(
            ImportCustomerInterface::class,
            fn() => new RandomUserApi\ImportCustomerService()
        );
        // $this->app->singleton(
        //     ImportCustomerInterface::class,
        //     fn() => new Test\ImportCustomerService()
        // );
    }
}
