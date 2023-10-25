<?php

declare(strict_types=1);

namespace Payment\Domain\Payment;

use App\Domain\EntityNotFound;

class UserNotFound extends EntityNotFound
{
    public function __construct(string $id)
    {
        parent::__construct('user', ['id' => $id]);
    }
}
