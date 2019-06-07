<?php

namespace App\CurrencyRate;

use App\CurrencyRate\Interfaces\CurrencyApi;
use Illuminate\Support\ServiceProvider;

class CurrencyRateServiceProvider extends ServiceProvider
{
    public $singletons = [
        CurrencyApi::class => CurrencyConverterApi::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
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
