<?php

namespace App\Providers;

use App\Repositories\Implementations\CurrencyProfileRepositoryImpl;
use App\Repositories\Implementations\CurrencyRateRepositoryImpl;
use App\Repositories\Interfaces\CurrencyProfileRepository;
use App\Repositories\Interfaces\CurrencyRateRepository;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        CurrencyProfileRepository::class => CurrencyProfileRepositoryImpl::class,
        CurrencyRateRepository::class => CurrencyRateRepositoryImpl::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Client::class, function () {
            return new Client();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
