<?php

declare(strict_types=1);

namespace Unit\Presenter\Http\Payment;

use App\Application\User\Create\CreateUserCommand;
use App\Application\User\Create\CreateUserCommandHandler;
use App\Application\User\Load\LoadUserQuery;
use App\Application\User\Load\LoadUserQueryHandler;
use App\Domain\User\User;
use App\Domain\User\UserNotFound;
use App\Presenter\Http\User\Create\CreateUserController;
use App\Presenter\Http\User\Create\CreateUserRequest;
use App\Presenter\Http\User\Load\LoadUserController;
use DateTimeImmutable;
use Mockery;
use Mockery\MockInterface;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LoadUserControllerTest extends TestCase
{
    private LoadUserQueryHandler&MockInterface $handler;

    private LoadUserController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = $this->mock(LoadUserQueryHandler::class);
        $this->controller = app(LoadUserController::class);
    }

    public function testGivenInvalidIdQueryItShouldReturnHttpNotFound(): void
    {
        $this->handler
            ->shouldReceive('handle')
            ->once()
            ->andThrow(new UserNotFound(1));

        $response = $this->controller->__invoke(1);

        $this->assertEquals('{"error":"User Not Found","details":{"id":1}}', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testGivenQueryItShouldReturnFound(): void
    {
        $this->handler
            ->shouldReceive('handle')
            ->once()
            ->andReturn( new User(
                id: 0,
                name: '',
                email: '',
                password: '',
                createdAt: new DateTimeImmutable('2023-09-09 00:15:00')
            ));

        $response = $this->controller->__invoke(1);

        $this->assertEquals('{"id":0,"name":"","email":"","password":"","createdAt":{"date":"2023-09-09 00:15:00.000000","timezone_type":3,"timezone":"UTC"}}', $response->getContent());
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
