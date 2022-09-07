<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request)
{
    return $request->user();
});
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->get('user/favorites', [UserController::class, 'favorites']);

Route::middleware('auth:sanctum')->post('movie/{movie}/add', [MovieController::class, 'addToFavorites']);
Route::get('movie/ranking', [MovieController::class, 'ranking']);
Route::resource('movie', MovieController::class);
Route::resource('comment', CommentController::class);
