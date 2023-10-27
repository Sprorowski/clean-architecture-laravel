<?php

declare(strict_types=1);

namespace App\Application;

class Command
{
    public function getProperties(): array
    {
        return get_object_vars($this);
    }
}
