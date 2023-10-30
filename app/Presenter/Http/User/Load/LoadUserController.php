<?php

declare(strict_types=1);

namespace App\Presenter\Http\User\Load;

use App\Application\User\Load\LoadUserQuery;
use App\Application\User\Load\LoadUserQueryHandler;
use App\Domain\User\UserNotFound;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LoadUserController
{
    public function __construct(
        private readonly LoadUserQueryHandler $loadHandler
    ) {
    }

    public function __invoke(int $userId): JsonResponse | Response
    {
        try{
            $query = new LoadUserQuery($userId);
            $user = $this->loadHandler->handle($query);
        }catch(UserNotFound $e){
            return new JsonResponse([
                'error' => $e->getMessage(),
                'details'=> 
                $e->getDetails()
            ], Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(
            $user, Response::HTTP_OK);
    }
}
