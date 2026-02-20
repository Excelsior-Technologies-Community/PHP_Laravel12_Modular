<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Controllers\UserController;

Route::get('/users', [UserController::class, 'index']);