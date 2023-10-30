<?php

declare(strict_types=1);

namespace Unit\Presenter\Http\Payment;

use App\Application\User\Create\CreateUserCommand;
use App\Application\User\Create\CreateUserCommandHandler;
use App\Presenter\Http\User\Create\CreateUserController;
use App\Presenter\Http\User\Create\CreateUserRequest;
use Mockery;
use Mockery\MockInterface;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateUserControllerTest extends TestCase
{
    private CreateUserCommandHandler&MockInterface $handler;

    private CreateUserController $controller;

    private CreateUserRequest&MockInterface $request;

    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = $this->mock(CreateUserCommandHandler::class);
        $this->request = $this->mock(CreateUserRequest::class);
        $this->controller = app(CreateUserController::class);
    }

    public function testGivenCommandItShouldReturnHttpCreated(): void
    {
        $this->handler
            ->shouldReceive('handle')
            ->once()
            ->with(Mockery::on(fn($arg) => $arg == new CreateUserCommand(
                name: 'name',
                email: 'email',
                password: 'password',
            )));

        $this->request
            ->shouldReceive('toCommand')
            ->once()
            ->andReturn(new CreateUserCommand(
                name: 'name',
                email: 'email',
                password: 'password',
            ));

        $response = $this->controller->__invoke($this->request);

        $this->assertEquals('', $response->getContent());
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }
}
