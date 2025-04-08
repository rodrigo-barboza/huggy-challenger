<?php

namespace App\Providers;

use App\Insights\InsightsRegistry;
use App\Services\TwilioService;
use Illuminate\Support\ServiceProvider;
use Twilio\Rest\Client;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->when(TwilioService::class)
            ->needs(Client::class)
            ->give(fn (): Client => new Client(
                config('services.twilio.account_sid'),
                config('services.twilio.auth_token'))
            );
    }

    public function boot(): void
    {
        $this->app->singleton(
            InsightsRegistry::class,
            fn ($app): InsightsRegistry => new InsightsRegistry([
                $app->make(\App\Insights\ContactsByStateInsights::class),
                $app->make(\App\Insights\ContactsWithPhoneInsights::class),
            ])
        );
    }
}
