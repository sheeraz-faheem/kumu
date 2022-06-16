<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\HammingDistanceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(RegisterController::class)->group(function() {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->controller(GithubController::class)->prefix('github')->group(function() {
    Route::get('/users', 'getUsers');
});

Route::middleware('auth:sanctum')->controller(HammingDistanceController::class)->prefix('hd')->group(function() {
    Route::get('/', 'hammingDistance');
});
