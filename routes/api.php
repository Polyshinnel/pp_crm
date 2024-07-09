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



Route::group(
    [
        'middleware' => 'jwt.auth',
        'prefix' => 'categories'
    ], function () {
    Route::get('', \App\Http\Controllers\Category\IndexController::class);
    Route::get('/selectTree', \App\Http\Controllers\Category\SelectTreeController::class);
    Route::get('/{category}', \App\Http\Controllers\Category\ShowController::class);
    Route::post('', \App\Http\Controllers\Category\StoreController::class);
    Route::patch('/{category}', \App\Http\Controllers\Category\UpdateController::class);
    Route::delete('/{category}', \App\Http\Controllers\Category\DestroyController::class);
});

Route::group(
    [
        'middleware' => 'jwt.auth',
        'prefix' => 'chars'
    ], function () {
    Route::get('', \App\Http\Controllers\Char\IndexController::class);
    Route::get('/{char}', \App\Http\Controllers\Char\ShowController::class);
    Route::post('', \App\Http\Controllers\Char\StoreController::class);
    Route::patch('/{char}', \App\Http\Controllers\Char\UpdateController::class);
    Route::delete('/{char}', \App\Http\Controllers\Char\DestroyController::class);
});

Route::group(
    [
        'middleware' => 'jwt.auth',
        'prefix' => 'params'
    ], function () {
    Route::get('', \App\Http\Controllers\Param\IndexController::class);
    Route::get('/{param}', \App\Http\Controllers\Param\ShowController::class);
    Route::post('', \App\Http\Controllers\Param\StoreController::class);
    Route::patch('/{param}', \App\Http\Controllers\Param\UpdateController::class);
    Route::delete('/{param}', \App\Http\Controllers\Param\DestroyController::class);
});


Route::group(
    [
        'middleware' => 'jwt.auth',
        'prefix' => 'products'
    ], function () {
    Route::get('', \App\Http\Controllers\Product\IndexController::class);
    Route::get('/{product}', \App\Http\Controllers\Product\ShowController::class);
    Route::post('', \App\Http\Controllers\Product\StoreController::class);
    Route::patch('/{product}', \App\Http\Controllers\Product\UpdateController::class);
    Route::delete('/{product}', \App\Http\Controllers\Product\DestroyController::class);
});
