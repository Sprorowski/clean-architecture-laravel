<?php

declare(strict_types=1);

namespace App\Application;

interface QueryHandler
{
    public function handle(Query $command);
}
