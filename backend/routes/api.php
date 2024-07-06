<?php

use App\Http\Controllers\Api\Auth\LikeController;
use App\Http\Controllers\Api\Auth\PostController;
use App\Http\Controllers\Api\Auth\AuthController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

// });

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::controller(PostController::class)->group(function(){
        Route::post('/post', 'post');
        Route::get('/getAllPost', 'getAllPost');
        Route::put('/update/{postId}', 'update');
        Route::delete('deletePost/{postId}', 'deletePost');
    });
    Route::controller(AuthController::class)->group(function(){
        Route::put('/editProfile/{userId}', 'editProfile');
        Route::get('getUserData/{userId}', 'getUserData');
        Route::get('getThisUserData/{username}', 'getThisUserData');
    });
    Route::controller(LikeController::class)->group(function(){
        Route::post('/like', 'like');
    });
});

Route::controller(AuthController::class)->group(function(){
    Route::post('/signup', 'signup');
    Route::post('/login', 'login');
});

