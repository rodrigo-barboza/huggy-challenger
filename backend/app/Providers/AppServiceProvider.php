<?php

namespace App\Providers;

use App\Insights\InsightsRegistry;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->app->singleton(InsightsRegistry::class, function ($app) {
            return new InsightsRegistry([
                $app->make(\App\Insights\ContactsByStateInsights::class),
            ]);
        });
    }
}
