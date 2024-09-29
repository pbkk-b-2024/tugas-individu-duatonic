<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('home')->middleware('auth');

//Auth routes
Route::get('/login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

//Items routes
Route::get('/items', [ItemsController::class, 'index'])->name('items');
Route::get('/items/add', [ItemsController::class, 'add'])->name('items.add');
Route::post('/items/add', [ItemsController::class, 'store'])->name('items.store');
Route::get('/items/edit/{id}', [ItemsController::class, 'edit'])->name('items.edit');
Route::put('/items/edit/{id}', [ItemsController::class, 'update'])->name('items.update');
Route::delete('/items/{id}', [ItemsController::class, 'destroy'])->name('items.destroy');

//Users routes
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/add', [UserController::class, 'add'])->name('users.add');
Route::post('/users/add', [UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/edit/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

//Roles routes
Route::get('/roles', [RoleController::class, 'index'])->name('roles');
Route::get('/roles/add', [RoleController::class, 'add'])->name('roles.add');
Route::post('/roles/add', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/edit/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

//Fallback route
Route::fallback(function () {
    return view('error');
});