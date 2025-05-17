<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BooksController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // User profile routes
    Route::get('/profile', [UserController::class, 'profile']);
    Route::put('/profile', [UserController::class, 'updateProfile']);

    // Books routes
    Route::get('/books', [BooksController::class, 'index']);
    Route::middleware('role:admin')->group(function () {
        Route::post('/books', [BooksController::class, 'store']);
        Route::put('/books/{book}', [BooksController::class, 'update']);
        Route::delete('/books/{book}', [BooksController::class, 'destroy']);
    });

    // Admin routes
    Route::middleware('admin')->group(function () {
        // User management
        Route::get('/admin/users', [AdminController::class, 'users']);
        Route::post('/admin/users', [AdminController::class, 'createUser']);
        Route::put('/admin/users/{user}', [AdminController::class, 'updateUser']);
        Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser']);
    });
});

// Simple test endpoint
Route::get('/test-connection', function () {
    return response()->json([
        'message' => 'Backend is connected successfully!',
        'timestamp' => now()
    ]);
});