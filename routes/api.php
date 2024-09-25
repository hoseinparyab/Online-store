<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiPostsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::namespace('Api')->group(function(){

    Route::get('/posts', [ApiPostsController::class, 'index']);
    Route::post('/posts', [ApiPostsController::class, 'store']);
    Route::put('/posts/{id}', [ApiPostsController::class, 'update']);
    Route::delete('/posts/{id}', [ApiPostsController::class, 'destroy']);
});
