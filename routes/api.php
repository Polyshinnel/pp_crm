<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\CheckUser;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Brand\DestroyController;
use App\Http\Controllers\Brand\IndexController;
use App\Http\Controllers\Brand\StoreController;
use App\Http\Controllers\Brand\UpdateController;
use App\Http\Controllers\Common\UploadController;
use App\Http\Controllers\User\ShowController;
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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('register', RegisterController::class);
    Route::post('check-user', CheckUser::class);
});

Route::post('/common/upload-image', UploadController::class);

Route::group(
    [
        'middleware' => 'jwt.auth',
        'prefix' => 'users'
    ], function () {
    Route::get('me', ShowController::class);
});

Route::group(
    [
        'middleware' => 'jwt.auth',
        'prefix' => 'brands'
    ], function () {
    Route::get('', IndexController::class);
    Route::get('/{brand}', \App\Http\Controllers\Brand\ShowController::class);
    Route::post('', StoreController::class);
    Route::patch('/{brand}', UpdateController::class);
    Route::delete('/{brand}', DestroyController::class);
});



