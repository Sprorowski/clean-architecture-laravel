<?php

declare(strict_types=1);

namespace App\Application\User\Create;

use App\Application\Command;
use App\Domain\User\User;
use App\Domain\User\Users;

class CreateUserCommandHandler extends Command
{
    public function __construct(
        private readonly Users $users
    ) {
    }

    public function handle(CreateUserCommand $command): void
    {
        $user = User::create(null, ...$command->getProperties());
        $this->users->create($user);
    }
}
