<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();  // Mengembalikan data pengguna yang terautentikasi
});

// Menggunakan apiResource untuk CRUD Admin dan User
Route::apiResource('/admin', AdminController::class);  
Route::apiResource('/user', UserController::class);

// Jika Anda ingin menambahkan rute kustom seperti profil user:
Route::get('/user/{id}/profile', [UserController::class, 'profile'])->middleware('auth:sanctum');
