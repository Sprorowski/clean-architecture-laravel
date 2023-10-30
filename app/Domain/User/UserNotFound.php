<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\EntityNotFound;

class UserNotFound extends EntityNotFound
{
    public function __construct(int $id)
    {
        parent::__construct('user', ['id' => $id]);
    }
}
