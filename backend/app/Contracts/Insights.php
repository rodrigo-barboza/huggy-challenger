<?php

declare(strict_types=1);

namespace App\Contracts;

interface Insights
{
    public function name(): string;
    public function execute(): array;
}
