<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them
| will be assigned to the "web" middleware group. Make something great!
|
*/

// Главная страница
Route::get('/', function () {
    return view('home');
});

// Маршрут для формы регистрации
Route::get('/register', [AuthController::class, 'register'])->name('register');

// Маршрут для обработки регистрации
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');

// Маршрут для формы входа
Route::get('/login', [AuthController::class, 'login'])->name('login');

// Маршрут для обработки входа
Route::post('/login', [AuthController::class, 'storeLogin'])->name('login.store');

// Маршрут для выхода из системы
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Защищённые маршруты, доступные только для авторизованных пользователей
Route::middleware('auth')->group(function () {
    // Личный кабинет (пользователь может видеть только свой)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

    // Личный кабинет администратора (может видеть всех пользователей)
    Route::get('/admin/profiles', [ProfileController::class, 'index'])
        ->middleware('role:admin')
        ->name('admin.profiles');
});
