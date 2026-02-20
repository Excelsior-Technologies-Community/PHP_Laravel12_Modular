<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);