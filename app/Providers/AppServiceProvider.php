<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\OpenAiSentimentService;
use App\Services\LocalSentimentService;
use App\Services\SentimentManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(OpenAiSentimentService::class, function ($app) {
            return new OpenAiSentimentService(/* inject config or client here */);
        });

        $this->app->singleton(LocalSentimentService::class, function ($app) {
            return new LocalSentimentService();
        });

        $this->app->singleton(SentimentManager::class, function ($app) {
            return new SentimentManager(
                $app->make(OpenAiSentimentService::class),
                $app->make(LocalSentimentService::class),
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
