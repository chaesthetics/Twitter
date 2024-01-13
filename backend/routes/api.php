<?php

use App\Http\Controllers\Api\Auth\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
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
//     return $request->user();
// });

Route::controller(AuthController::class)->group(function(){
    Route::post('/signup', 'signup');
    Route::post('/login', 'login');
    Route::put('/editProfile/{userId}', 'editProfile');
    Route::get('getUserData/{userId}', 'getUserData');
});

Route::controller(PostController::class)->group(function(){
    Route::post('/post', 'post');
    Route::get('/getAllPost', 'getAllPost');
    Route::put('/update/{postId}', 'update');
    Route::delete('deletePost/{postId}', 'deletePost');
});