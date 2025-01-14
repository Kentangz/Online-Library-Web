<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\FineController;

// Route untuk login admin
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/user/login', [UserController::class, 'login']);

// Route lainnya dengan apiResource
Route::apiResource('/admin', AdminController::class);  
Route::apiResource('/user', UserController::class);
Route::apiResource('/category', CategoryController::class);
Route::apiResource('/book', BookController::class);
Route::apiResource('/transaction', TransactionController::class);
Route::apiResource('/fine', FineController::class);
