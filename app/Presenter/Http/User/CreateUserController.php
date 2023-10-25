<?php

declare(strict_types=1);

namespace App\Presenter\Http\User;

use App\Application\User\Create\CreateUserCommand;
use App\Application\User\Create\CreateUserCommandHandler;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController
{
    public function __construct(
        private readonly CreateUserCommandHandler $createHandler
    ) {
    }

    public function __invoke(): Response
    {
        $this->createHandler->handle(new CreateUserCommand("Name"));

        return new Response("aaaaa", Response::HTTP_CREATED);
    }
}
