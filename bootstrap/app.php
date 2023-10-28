<?php

declare(strict_types=1);

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

//This belongs to present, add it there as needed
$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Presenter\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Presenter\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Presenter\Exceptions\Handler::class
);

return $app;
