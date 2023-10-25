<?php

declare(strict_types=1);

namespace App\Domain;

use Exception;

class DomainException extends Exception
{
    /** @var array<string, string|int|float|bool|null> */
    private array $details;

    /**
     * @param array<string, string|int|float|bool|null> $details
     */
    public function __construct(string $message, array $details)
    {
        parent::__construct($message);

        $this->details = $details;
    }

    public function getDetails(): array
    {
        return $this->details;
    }
}
