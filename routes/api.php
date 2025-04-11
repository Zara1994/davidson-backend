<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReviewController;

    Route::apiResource('categories', CategoryController::class)->only(['index']);
    Route::apiResource('projects', ProjectController::class)->only(['index']);
    Route::apiResource('reviews', ReviewController::class)->only(['index']);

    //https://davidson-backend.local/api/categories/1/products

    Route::apiResource('categories.products', ProductController::class)->only(['index']);

    Route::apiResource('contact', ContactController::class)->only(['store']);
    Route::apiResource('visit', \App\Http\Controllers\VisitController::class)->only(['store']);




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
