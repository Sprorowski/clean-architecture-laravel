<?php

declare(strict_types=1);

namespace App\Domain\User;

use DateTimeImmutable;

class User
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $email,
        public readonly DateTimeImmutable $createdAt,
    ) {
    }

    public static function create(string $name): self
    {
        return new self(
            id: '',
            name: '',
            email: '',
            createdAt: new DateTimeImmutable('2023-09-09 00:15:00'),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name
        ];
    }

    public static function fromArray(
        array $data
    ): self {
        return new self(
            id: $data['id'],
            name: $data['name'],
            email: $data['email'],
            createdAt: $data['createdAt'],
        );
    }
}
