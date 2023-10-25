<?php

declare(strict_types=1);

use App\Presenter\Http\User\CreateUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/user')->group(function () {
    Route::get('', CreateUserController::class);
});
