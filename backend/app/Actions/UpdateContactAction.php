<?php

declare(strict_types=1);

namespace App\Actions;

use App\Dtos\ContactDto;
use App\Events\ContactUpdated;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

final class UpdateContactAction
{
    public function handle(ContactDto $contactDto, Contact $contact): void
    {
        DB::transaction(function () use ($contactDto, $contact): void {
            $contact->update($contactDto->toArray());

            ContactUpdated::dispatch($contact->refresh());
        });
    }
}
