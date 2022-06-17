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
        if (env('GITHUB_PAT')) {
            $headers['Authorization'] = 'token '.env('GITHUB_PAT');    
        }

        $headers = [
            'X-Requested-With' => 'XMLHttpRequest',
            'Content-Type' => 'application/json',
        ];

        $this->app->singleton(GithubClient::class, function () use ($headers) {
            return new GithubClient(new Client([
                'base_uri' => config('domains.github.uri'),
                'headers' => $headers,
            ]));
        });
    }
}
