<?php

declare(strict_types=1);

namespace Tests\Unit\Application\User\Create;

use App\Application\User\Create\CreateUserCommand;
use App\Application\User\Create\CreateUserCommandHandler;
use App\Domain\User\User;
use App\Domain\User\Users;
use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class CreateUserCommandHandlerTest extends TestCase
{
    private CreateUserCommandHandler $commandHandler;

    private Users&MockObject $payments;

    public function setUp(): void
    {
        $this->payments = $this->createMock(Users::class);
        $this->commandHandler = new CreateUserCommandHandler($this->payments);
    }

    public function testCreatePaymentCommandHandler(): void
    {
        $command = new CreateUserCommand(
            name: '',
            email: '',
            password: '',
        );
        $this->payments
            ->expects($this->once())
            ->method('create')
            ->with(
                new User(
                    id: 0,
                    name: '',
                    email: '',
                    password: '',
                    createdAt: new DateTimeImmutable('2023-09-09 00:15:00')
                )
            );

        $this->commandHandler->handle($command);
    }
}
