<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\ContactCreated;
use App\Jobs\SendContactCreatedWebhook;
use App\Models\Webhook;
use Illuminate\Contracts\Queue\ShouldQueue;

final class SendContactCreatedWebhookListener implements ShouldQueue
{
    public function handle(ContactCreated $event): void
    {
        $webhookUrls = Webhook::whereEvent('user.created')->pluck('url');

        foreach ($webhookUrls as $url) {
            SendContactCreatedWebhook::dispatch($event->contact->toArray(), $url);
        }
    }
}
