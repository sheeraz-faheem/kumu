<?php

namespace App\Services\HttpClients;

use Illuminate\Http\JsonResponse;

class GithubClient extends AbstractClient
{
    /**
     * Get users.
     */
    public function users(array $query = []): JsonResponse
    {
        return $this->request('GET', '/users', [
            'query' => $query,
        ]);
    }

    /**
     * Get user data.
     */
    public function user(string $username): JsonResponse
    {
        return $this->request('GET', "/users/$username");
    }
}
