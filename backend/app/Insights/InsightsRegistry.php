<?php

declare(strict_types=1);

namespace App\Insights;

use App\Contracts\Insights;

final class InsightsRegistry
{
    protected array $insights = [];

    public function __construct(array $insights = [])
    {
        foreach ($insights as $insight) {
            $this->register($insight);
        }
    }

    public function register(Insights $insight): void
    {
        $this->insights[$insight->name()] = $insight;
    }

    public function get(string $name): ?Insights
    {
        return $this->insights[$name] ?? null;
    }

    public function all(): array
    {
        return $this->insights;
    }
}
