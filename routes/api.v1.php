<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [RegisterController::class, 'register']);
Route::apiResource('categories', CategoryController::class)->names('api.v1.categories');
Route::apiResource('products', ProductController::class)->names('api.v1.products');
Route::apiResource('brands', BrandController::class)->names('api.v1.brands');
//! Added tags resource Pending
Route::apiResource('tags', TagController::class)->names('api.v1.tags');

// * Testing
Route::get('/login', [LoginController::class, 'store']);


/**
 * 
 Route::middleware('auth:api')->get('/user', function (Request $request) {
     return $request->user();
 });
 * 
 */
