<?php

declare(strict_types=1);

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendContactCreatedWebhook implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public array $contact,
        public string $webhookUrl
    ) {}

    public function handle(): void
    {
        $response = Http::timeout(15)
            ->retry(3, 1000)
            ->post($this->webhookUrl, $this->contact);

        $response->throw();
    }

    public function failed(\Throwable $exception): void
    {
        Log::channel('webhooks')
            ->error('Webhook falhou após retentativas', [
                'user_id' => $this->contact['id'] ?? null,
                'error' => $exception->getMessage()
            ]);
    }
}
