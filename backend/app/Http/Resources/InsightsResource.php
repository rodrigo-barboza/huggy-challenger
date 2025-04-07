<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Contracts\Insights;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InsightsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return collect($this->resource)
            ->mapWithKeys(fn (Insights $insight) => [
                $insight->name() => [
                    'title' => $insight->title(),
                    'data' => $insight->execute()
                ],
            ])
            ->toArray();
    }
}
