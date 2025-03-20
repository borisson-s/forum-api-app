<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ThreadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::apiResource('threads', ThreadController::class);

Route::apiResource('posts', PostController::class)->except('index', 'store');
Route::get('threads/{thread}/posts', [PostController::class, 'index']);
Route::post('threads/{thread}/posts', [PostController::class, 'store']);
