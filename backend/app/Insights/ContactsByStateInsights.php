<?php

declare(strict_types=1);

namespace App\Insights;

use App\Contracts\Insights;
use App\Models\Contact;

final class ContactsByStateInsights implements Insights
{
    public function name(): string
    {
        return 'contacts-by-state';
    }

    public function title(): string
    {
        return 'Segmentação por estado';
    }

    public function execute(): array
    {
        return Contact::selectRaw('state, COUNT(*) as total')
            ->groupBy('state')
            ->orderByDesc('total')
            ->get()
            ->toArray();
    }
}
