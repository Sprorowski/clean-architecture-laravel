<?php

declare(strict_types=1);

namespace App\Presenter\Providers;

use App\Domain\User\Users;
use App\Infrastructure\Database\EloquentUsers;
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
        //
    }

    private function registerRepositories(): void
    {
        $this->app->bind(Users::class, EloquentUsers::class);
    }
}
