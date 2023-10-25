<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    'name' => env('APP_NAME', 'Laravel'),

    'env' => env('APP_ENV', 'production'), 

    'debug' => (bool) env('APP_DEBUG', false),   

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),   

    'timezone' => 'UTC',   

    'locale' => 'en',

    'fallback_locale' => 'en',    

    'faker_locale' => 'en_US',

    'key' => env('APP_KEY'),
    
    'cipher' => 'AES-256-CBC',

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    'providers' => ServiceProvider::defaultProviders()->merge([
        App\Presenter\Providers\AppServiceProvider::class,
        App\Presenter\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Presenter\Providers\EventServiceProvider::class,
        App\Presenter\Providers\RouteServiceProvider::class,
    ])->toArray(),  

    'aliases' => Facade::defaultAliases()->merge([
        // 'Example' => App\Facades\Example::class,
    ])->toArray(),

];
