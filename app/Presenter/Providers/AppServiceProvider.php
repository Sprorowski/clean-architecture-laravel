<?php

declare(strict_types=1);

namespace App\Presenter\Providers;

use App\Domain\User\Users;
use App\Infrastructure\Database\EloquentUsers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerRepositories();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return 'Database\\Factories\\' . class_basename($modelName) . 'Factory';
        });
        Factory::guessModelNamesUsing(function($string){
            return 'App\\Infrastructure\\Database\\Models\\'  . str_replace('Factory', '', class_basename($string));
        });
        //
    }

    private function registerRepositories(): void
    {
        $this->app->bind(Users::class, EloquentUsers::class);
    }
}
