<?php

namespace App\Services\HttpClients;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class GithubClient extends AbstractClient
{
    /**
     * Get users.
     */
    public function users(array $query = []): JsonResponse
    {
        $key = Str::random(16);

        return Cache::remember($key, 120, function () use ($query) {
            return $this->request('GET', '/users', [
                'query' => $query,
            ]);
        });

    }

    /**
     * Get user data.
     */
    public function user(string $username): JsonResponse
    {
        $key = Str::random(16);

        return Cache::remember($key, 120, function () use ($username) {
            return $this->request('GET', "/users/$username");
        });
    }
}
