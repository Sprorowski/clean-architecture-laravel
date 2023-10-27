<?php

declare(strict_types=1);

namespace App\Domain\User;

interface Users
{
    public function get(string $id): User;

    public function create(User $user): void;
}
