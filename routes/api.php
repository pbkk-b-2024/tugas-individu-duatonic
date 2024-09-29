<?php

use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\ItemsController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

//API routes
Route::prefix('api')->group(function () {
    Route::post('/register', [RegisterController::class]);
    Route::post('/login', [LoginController::class]);
    Route::post('/logout', [LoginController::class]);

    Route::prefix('/items')->group(function () {
        Route::get('/', [ItemsController::class, 'index']);
        Route::get('/{id}', [ItemsController::class, 'single']);
        Route::post('/', [ItemsController::class, 'store']); // No {id} for POST (creating new items)
        Route::put('/{id}', [ItemsController::class, 'update']);
        Route::delete('/{id}', [ItemsController::class, 'destroy']);
    });
       

    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'single']);
        Route::post('/{id}', [UserController::class, 'store']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });

    Route::prefix('/roles')->group(function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::get('/{id}', [RoleController::class, 'single']);
        Route::post('/{id}', [RoleController::class, 'store']);
        Route::put('/{id}', [RoleController::class, 'update']);
        Route::delete('/{id}', [RoleController::class, 'destroy']);
    });
});

//Fallback route
Route::fallback(function () {
    return response()->json(['message' => 'Not Found'], 404);
});