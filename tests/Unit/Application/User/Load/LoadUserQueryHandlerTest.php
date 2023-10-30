<?php

declare(strict_types=1);

namespace Tests\Unit\Application\User\Create;

use App\Application\User\Create\CreateUserCommand;
use App\Application\User\Create\CreateUserCommandHandler;
use App\Application\User\Load\LoadUserQuery;
use App\Application\User\Load\LoadUserQueryHandler;
use App\Domain\User\User;
use App\Domain\User\Users;
use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class LoadUserQueryHandlerTest extends TestCase
{
    private LoadUserQueryHandler $queryHandler;

    private Users&MockObject $users;

    public function setUp(): void
    {
        $this->users = $this->createMock(Users::class);
        $this->queryHandler = new LoadUserQueryHandler($this->users);
    }

    public function testLoadUserQueryHandler(): void
    {
        $query = new LoadUserQuery(
            id: 1,
        );
        $this->users
            ->expects($this->once())
            ->method('get')
            ->with(
                1
            )->willReturn(
                new User(
                    id: 0,
                    name: '',
                    email: '',
                    password: '',
                    createdAt: new DateTimeImmutable('2023-09-09 00:15:00')
                )
            );

        $this->queryHandler->handle($query);
    }
}
