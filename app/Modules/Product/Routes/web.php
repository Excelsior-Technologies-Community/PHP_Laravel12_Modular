<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Controllers\ProductController;


Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/create', [ProductController::class, 'create']);
Route::post('/products', [ProductController::class, 'store']);

// LIVE SEARCH ROUTE
Route::get('/products/search', [ProductController::class, 'search']);