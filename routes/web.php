<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AvatarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/add', [ItemController::class, 'add'])->name('items.add');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
Route::get('/items/{id}', [ItemController::class, 'edit'])->name('items.edit');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/add', [UserController::class, 'add'])->name('users.add');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/edit/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/add', [RoleController::class, 'add'])->name('roles.add');
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/{id}', [RoleController::class, 'edit'])->name('roles.edit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile/picture-options', [AvatarController::class, 'showOptions'])->name('profile.picture-options');
//     Route::post('/profile/picture-update', [AvatarController::class, 'update'])->name('profile.picture-update');
//     Route::post('/profile/picture-upload', [AvatarController::class, 'upload'])->name('profile.picture-upload');
// });

require __DIR__.'/auth.php';
