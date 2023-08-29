<?php

use App\Models\User;
use EightSleep\App\SleepMetrics\SleepSession\V1\GetSleepIntervalController;
use EightSleep\App\SleepMetrics\SleepSession\V1\IngestSessionDataController;
use EightSleep\App\SleepMetrics\SleepSession\V1\ListSleepIntervalsController;
use EightSleep\App\User\LinkAccounts\V1\CancelAccountLinkingController;
use EightSleep\App\User\LinkAccounts\V1\CompleteAccountLinkingController;
use EightSleep\App\User\LinkAccounts\V1\InitiateAccountLinkingController;
use EightSleep\App\User\LinkAccounts\V1\ListAccountLinkRequestsController;
use EightSleep\App\User\LinkAccounts\V1\ListLinkedUserAccountsController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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

Route::middleware(['auth:sanctum', 'request.user'])->group(function () {
    Route::post('/v1/sleep/session', [IngestSessionDataController::class, 'handle']);
    Route::get('/v1/sleep/interval/list', [ListSleepIntervalsController::class, 'handle']);
    Route::get('/v1/sleep/interval', [GetSleepIntervalController::class, 'handle']);
    Route::get('/v1/user/link', [ListLinkedUserAccountsController::class, 'handle']);
    Route::get('/v1/user/link/request', [ListAccountLinkRequestsController::class, 'handle']);
    Route::post('/v1/user/link/request', [InitiateAccountLinkingController::class, 'handle']);
    Route::delete('/v1/user/link/request', [CancelAccountLinkingController::class, 'handle']);
    Route::put('/v1/user/link/request', [CompleteAccountLinkingController::class, 'handle']);
});

Route::post('/v1/auth/login', function (Request $request) {
    try {
        $validateUser = Validator::make(json_decode($request->getContent(), true),
            [
                'email'    => 'required|email',
                'password' => 'required',
            ]);

        if ($validateUser->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'validation error',
                'errors'  => $validateUser->errors(),
            ], 401);
        }

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status'  => false,
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'status'  => true,
            'message' => 'User Logged In Successfully',
            'token'   => $user->createToken("API TOKEN")->plainTextToken,
        ], 200);

    }
    catch (\Throwable $th) {
        return response()->json([
            'status'  => false,
            'message' => $th->getMessage(),
        ], 500);
    }
});
