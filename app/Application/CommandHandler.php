<?php

declare(strict_types=1);

namespace App\Application;

interface CommandHandler
{
    public function handle(Command $command);
}
