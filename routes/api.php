<?php

use EightSleep\App\Authentication\Login\V1\LoginController;
use EightSleep\App\SleepMetrics\SleepSession\V1\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/v1/auth/login', [LoginController::class, 'handle']);

Route::post('/v1/sleep/session', [SessionController::class, 'handle']);
