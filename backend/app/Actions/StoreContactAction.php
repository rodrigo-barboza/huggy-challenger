<?php

declare(strict_types=1);

namespace App\Actions;

use App\Dtos\ContactDto;
use App\Events\ContactCreated;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

final class StoreContactAction
{
    public function handle(ContactDto $contact): void
    {
        DB::transaction(function () use ($contact): void {
            $user = Contact::create($contact->toArray());

            ContactCreated::dispatch($user);
        });
    }
}
