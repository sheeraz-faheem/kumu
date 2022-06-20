<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Services\HttpClients\GithubClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\JsonResponse;

class GithubController extends BaseController
{
    /**
     * Get user list
     */
    public function getUsers(Request $request): JsonResponse
    {
        try {
            $requestQuery = $request->query();
            data_set($requestQuery, 'per_page', 10);
        
            if ($request->exists('since')) {
                data_set($requestQuery, 'since', (int) $request->since);
            }

            $users = resolve(GithubClient::class)->users($requestQuery);

            $users = $users->getData();
            $githubUsers = [];

            foreach ($users as $k => $user) {
                $githubUsers[$k] = Cache::remember($user->login, 120, function () use ($user) {
                    return self::getUserData($user);
                });
            }

            $githubUsers = collect($githubUsers)->sortBy('id');        
            
            return response()->json($githubUsers);

        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error->getMessage()
            ]);
        }
        
    }

    /**
     * Get user data
     */
    private function getUserData($user)
    {
        $userData = resolve(GithubClient::class)->user($user->login);
        $data = $userData->getData();

        if ($userData->status() !== 404) {

            $averageRepoFollowers = $data->public_repos !== 0 ? 
                number_format($data->followers/$data->public_repos, 2) : "0.00";

            return [
                'name' => $data->name,
                'login' => $data->login,
                'company' => $data->company,
                'followers' => $data->followers,
                'public_repos' => $data->public_repos,
                'average_repo_followers' => $averageRepoFollowers,
            ];
        }
    }
}