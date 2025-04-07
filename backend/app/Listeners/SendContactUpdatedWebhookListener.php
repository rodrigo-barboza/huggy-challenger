<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\ContactUpdated;
use App\Jobs\SendContactCreatedWebhook;
use App\Models\Webhook;
use Illuminate\Contracts\Queue\ShouldQueue;

final class SendContactUpdatedWebhookListener implements ShouldQueue
{
    public function handle(ContactUpdated $event): void
    {
        $webhookUrls = Webhook::whereEvent('contact.updated')->pluck('url');

        foreach ($webhookUrls as $url) {
            SendContactCreatedWebhook::dispatch($event->contact->toArray(), $url);
        }
    }
}
