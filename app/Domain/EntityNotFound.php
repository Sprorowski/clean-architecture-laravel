<?php

declare(strict_types=1);

namespace App\Domain;

class EntityNotFound extends DomainException
{
    /**
     * @param array<string, string|int|float|bool|null> $details
     */
    public function __construct(string $name, array $details = [])
    {
        parent::__construct("$name Not Found", $details);
    }
}
