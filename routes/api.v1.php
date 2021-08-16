<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [RegisterController::class, 'register']);

Route::apiResource('categories', CategoryController::class)->names('api.v1.categories');

/**
 * 
 Route::middleware('auth:api')->get('/user', function (Request $request) {
     return $request->user();
 });
 * 
 */
