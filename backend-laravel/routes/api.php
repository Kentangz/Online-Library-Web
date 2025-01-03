<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); 
});


Route::apiResource('/admin', AdminController::class);  
Route::apiResource('/user', UserController::class);
Route::apiResource('/category', CategoryController::class);


Route::get('/user/{id}/profile', [UserController::class, 'profile'])->middleware('auth:sanctum');
