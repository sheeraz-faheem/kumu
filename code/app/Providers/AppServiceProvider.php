<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\HttpClients\GithubClient;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $headers = [
            'X-Requested-With' => 'XMLHttpRequest',
            'Content-Type' => 'application/json',
            'Authorization' => 'token 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',
        ];

        $this->app->singleton(GithubClient::class, function () use ($headers) {
            return new GithubClient(new Client([
                'base_uri' => config('domains.github.uri'),
                'headers' => $headers,
            ]));
        });
    }
}
