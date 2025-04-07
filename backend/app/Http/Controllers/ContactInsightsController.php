<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\InsightsResource;
use App\Insights\InsightsRegistry;

final class ContactInsightsController
{
    public function __invoke(InsightsRegistry $insights): InsightsResource
    {
        return InsightsResource::make($insights->all());
    }
}
