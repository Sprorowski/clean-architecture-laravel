<?php

declare(strict_types=1);

namespace App\Application\User\Create;

use App\Application\Command;

class CreateUserCommand extends Command
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password
    ) {
    }
}
