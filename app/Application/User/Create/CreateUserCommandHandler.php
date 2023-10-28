<?php

declare(strict_types=1);

namespace App\Application\User\Create;

use App\Application\Command;
use App\Application\CommandHandler;
use App\Domain\User\User;
use App\Domain\User\Users;

class CreateUserCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly Users $users
    ) {
    }

    public function handle(Command $command)
    {
        $user = User::create(null, ...$command->getProperties());
        $this->users->create($user);
    }
}
