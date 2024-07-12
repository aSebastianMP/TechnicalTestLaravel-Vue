<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('users', UserController::class);

Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::put('/users/{id}', [UserController::class, 'update']);



Route::middleware('auth:sanctum')->group(function(){
    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});



