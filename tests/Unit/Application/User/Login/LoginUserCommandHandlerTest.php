<?php

declare(strict_types=1);

namespace Tests\Unit\Application\User\Login;

use App\Application\User\Login\LoginUserCommand;
use App\Application\User\Login\LoginUserCommandHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Tests\TestCase;

class LoginUserCommandHandlerTest extends TestCase
{
    private LoginUserCommandHandler $commandHandler;


    public function setUp(): void
    {
        $this->commandHandler = new LoginUserCommandHandler();
    }

    public function testLoginUserCommandHandlerWithRightCredential(): void
    {
        $command = new LoginUserCommand(
            email: 'email',
            password: 'password',
        );
        Auth::shouldReceive('attempt')->once()->andReturn(true)->with([
            'email' => 'email',
            'password' => 'password'
        ]);

        $this->assertNull($this->commandHandler->handle($command));
    }

    public function testLoginUserCommandHandlerWithFail(): void
    {
        $command = new LoginUserCommand(
            email: 'email',
            password: 'password',
        );
        Auth::shouldReceive('attempt')->once()->andReturn(false)->with([
            'email' => 'email',
            'password' => 'password'
        ]);

        $this->expectException(UnauthorizedException::class);
        $this->commandHandler->handle($command);
    }
}
