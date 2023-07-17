<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\ProjectApiController;
use App\Http\Controllers\Api\TeamApiController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthApiController::class, 'login']);
    Route::post('/register', [AuthApiController::class, 'register']);
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::post('/refresh', [AuthApiController::class, 'refresh']);
});




Route::middleware(['jwt.verify'])->group(function () {

    Route::get('Blogs', [BlogApiController::class, 'index']);
    Route::get('Blogs/{id}', [BlogApiController::class, 'show']);
    Route::post('Blogs', [BlogApiController::class, 'store']);
    Route::patch('Blogs/{id}', [BlogApiController::class, 'update']);
    Route::delete('Blogs/{id}', [BlogApiController::class, 'destroy']);


    Route::get('Projects', [ProjectApiController::class, 'index']);
    Route::get('Projects/{id}', [ProjectApiController::class, 'show']);
    Route::post('Projects', [ProjectApiController::class, 'store']);
    Route::patch('Projects/{id}', [ProjectApiController::class, 'update']);
    Route::delete('Projects/{id}', [ProjectApiController::class, 'destroy']);


    Route::get('Teams', [TeamApiController::class, 'index']);
    Route::get('Teams/{id}', [TeamApiController::class, 'show']);
    Route::post('Teams', [TeamApiController::class, 'store']);
    Route::patch('Teams/{id}', [TeamApiController::class, 'update']);
    Route::delete('Teams/{id}', [TeamApiController::class, 'destroy']);

});




