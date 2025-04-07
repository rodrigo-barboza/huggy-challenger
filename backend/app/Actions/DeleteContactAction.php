<?php

declare(strict_types=1);

namespace App\Actions;

use App\Events\ContactDeleted;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

final class DeleteContactAction
{
    public function handle(Contact $contact): void
    {
        DB::transaction(function () use ($contact): void {
            $contact->delete();
            ContactDeleted::dispatch($contact);
        });
    }
}
