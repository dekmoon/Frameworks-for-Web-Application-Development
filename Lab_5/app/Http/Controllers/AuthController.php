<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Форма регистрации
    public function register()
    {
        return view('auth.register');
    }

    // Обработка регистрации
    public function storeRegister(Request $request)
    {
        // Валидация данных
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed', // проверка пароля
        ]);

        // Хешируем пароль
        $hashedPassword = Hash::make($request->password);

        // Создание нового пользователя с хешированным паролем
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
            'role' => 'user',  // Устанавливаем роль пользователя
        ]);

        // Перенаправление на страницу входа с сообщением
        return redirect()->route('login')->with('success', 'Регистрация успешна! Войдите в систему.');
    }

    // Форма входа
    public function login()
    {
        return view('auth.login');
    }

    // Обработка входа
    public function storeLogin(Request $request)
    {
        // Валидация данных
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Логируем входные данные для отладки
        \Log::info('Login attempt:', $request->only('email'));

        // Попытка аутентификации пользователя
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');  // Проверяем, был ли установлен флаг "remember"

        if (Auth::attempt($credentials, $remember)) {
            // Если успешный вход, перенаправляем на страницу личного кабинета
            return redirect()->route('dashboard')->with('success', 'Вы успешно вошли!');
        }

        // Если не удалось войти, возвращаем с ошибкой
        return back()->withErrors(['email' => 'Неверный email или пароль.']);
    }

    // Выход из системы
    public function logout()
    {
        Auth::logout(); // Выход
        return redirect()->route('login')->with('success', 'Вы вышли из системы.');
    }
}
