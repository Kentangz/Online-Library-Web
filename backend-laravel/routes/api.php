<?php

use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Controllers\AdminController;

Route::get('/user', function (Request $request) {
    return $request->user();  // Mengembalikan data pengguna yang terautentikasi
})->middleware(EnsureFrontendRequestsAreStateful::class);  // Middleware untuk Sanctum

Route::apiResource('/admin', AdminController::class);  // Rute resource untuk AdminController



