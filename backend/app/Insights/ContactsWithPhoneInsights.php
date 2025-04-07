<?php

declare(strict_types=1);

namespace App\Insights;

use App\Contracts\Insights;
use App\Models\Contact;

final class ContactsWithPhoneInsights implements Insights
{
    public function name(): string
    {
        return 'contacts-with-phone';
    }

    public function title(): string
    {
        return 'Usuários com e sem telefone';
    }

    public function execute(): array
    {
        return Contact::selectRaw('CASE WHEN phone IS NULL THEN 0 ELSE 1 END as has_phone, COUNT(*) as total')
            ->groupBy('has_phone')
            ->orderByDesc('total')
            ->get()
            ->map(function ($row) {
                $row->has_phone = $row->has_phone ? 'Sim' : 'Não';
                return $row;
            })
            ->toArray();
    }
}
