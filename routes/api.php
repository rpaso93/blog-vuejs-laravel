<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::get('/post/index/{date}', [PostController::class, 'index']);
Route::middleware('auth:sanctum')->get('/post/user/posts/{status}', [PostController::class, 'userPosts']);
Route::middleware('auth:sanctum')->post('/post/store', [PostController::class, 'store']);
Route::middleware('auth:sanctum')->put('/post/updateContent/{id}', [PostController::class, 'updateContent']);
Route::middleware('auth:sanctum')->put('/post/updateStatus/{id}', [PostController::class, 'updateStatus']);
Route::middleware('auth:sanctum')->delete('/post/delete/{id}', [PostController::class, 'destroy']);