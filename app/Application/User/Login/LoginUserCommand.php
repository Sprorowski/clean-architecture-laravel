<?php

declare(strict_types=1);

namespace App\Application\User\Login;

use App\Application\Command;

class LoginUserCommand extends Command
{
    public function __construct(
        public readonly string $email,
        public readonly string $password
    ) {
    }
}
