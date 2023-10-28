<?php

declare(strict_types=1);

namespace App\Application;

abstract class Command
{
    public function getProperties(): array
    {
        return get_object_vars($this);
    }
}
