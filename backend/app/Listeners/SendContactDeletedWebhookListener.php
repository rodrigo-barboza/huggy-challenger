<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\ContactDeleted;
use App\Jobs\SendContactCreatedWebhook;
use App\Models\Webhook;
use Illuminate\Contracts\Queue\ShouldQueue;

final class SendContactDeletedWebhookListener implements ShouldQueue
{
    public function handle(ContactDeleted $event): void
    {
        $webhookUrls = Webhook::whereEvent('contact.deleted')->pluck('url');

        foreach ($webhookUrls as $url) {
            SendContactCreatedWebhook::dispatch($event->contact->toArray(), $url);
        }
    }
}
