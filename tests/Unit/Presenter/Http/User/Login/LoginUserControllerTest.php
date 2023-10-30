<?php

declare(strict_types=1);

namespace Unit\Presenter\Http\Payment;

use App\Application\User\Login\LoginUserCommand;
use App\Application\User\Login\LoginUserCommandHandler;
use App\Presenter\Http\User\Login\LoginUserController;
use App\Presenter\Http\User\Login\LoginUserRequest;
use Illuminate\Validation\UnauthorizedException;
use Laravel\Sanctum\NewAccessToken;
use Mockery;
use Mockery\MockInterface;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LoginUserControllerTest extends TestCase
{
    private LoginUserCommandHandler&MockInterface $handler;

    private LoginUserController $controller;

    private LoginUserRequest&MockInterface $request;

    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = $this->mock(LoginUserCommandHandler::class);
        $this->request = $this->mock(LoginUserRequest::class);
        $this->controller = app(LoginUserController::class);
    }

    public function testGivenCommandItShouldReturnBearerToken(): void
    {
        $this->handler
            ->shouldReceive('handle')
            ->once()
            ->with(Mockery::on(fn($arg) => $arg == new LoginUserCommand(
                email: 'email',
                password: 'password',
            )));

        $this->request
            ->shouldReceive('toCommand')
            ->once()
            ->andReturn(new LoginUserCommand(
                email: 'email',
                password: 'password',
            ));

        $accessToken = $this->mock(NewAccessToken::class);

        $accessToken->plainTextToken = "token";

        $this->request
            ->shouldReceive('user->createToken')
            ->once()
            ->andReturn($accessToken);

        $response = $this->controller->__invoke($this->request);


        $this->assertEquals('{"token":"token"}', $response->getContent());
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }

    public function testGivenCommandItShouldReturnUnAuthorized(): void
    {
        $this->handler
            ->shouldReceive('handle')
            ->once()
            ->with(Mockery::on(fn($arg) => $arg == new LoginUserCommand(
                email: 'email',
                password: 'password',
            )))->andThrow(UnauthorizedException::class);

        $this->request
            ->shouldReceive('toCommand')
            ->once()
            ->andReturn(new LoginUserCommand(
                email: 'email',
                password: 'password',
            ));
        $response = $this->controller->__invoke($this->request);

        $this->assertEquals('', $response->getContent());
        $this->assertEquals(Response::HTTP_FORBIDDEN, $response->getStatusCode());
    }
}
