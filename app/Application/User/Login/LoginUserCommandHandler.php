<?php

declare(strict_types=1);

namespace App\Application\User\Login;

use App\Application\Command;
use App\Application\CommandHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class LoginUserCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly Auth $auth
    ) {
    }

    public function handle(Command $command): void
    {
        if (!Auth::attempt(...[$command->getProperties()])) {
            throw new UnauthorizedException("Fail to login");
        }
    }
}
