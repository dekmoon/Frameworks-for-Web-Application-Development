<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'storeLogin']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function () {return view('home');})->name('home')->middleware('auth');

Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('role:admin');


Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');

// Создание, редактирование и удаление постов (только для администраторов)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});
