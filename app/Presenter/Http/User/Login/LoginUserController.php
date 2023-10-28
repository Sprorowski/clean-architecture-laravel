<?php

declare(strict_types=1);

namespace App\Presenter\Http\User\Login;

use App\Application\User\Login\LoginUserCommandHandler;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LoginUserController
{
    public function __construct(
        private readonly LoginUserCommandHandler $loginUserCommandHandler
    ) {
    }

    public function __invoke(LoginUserRequest $request): JsonResponse
    {
        try {
            $this->loginUserCommandHandler->handle($request->toCommand());
        } catch (UnauthorizedException $e) {
            return new Response(null, Response::HTTP_FORBIDDEN);
        }
        $token = $request->user()->createToken('login')->plainTextToken;

        return new JsonResponse([
            'token' => $token
        ], Response::HTTP_CREATED);
    }
}
