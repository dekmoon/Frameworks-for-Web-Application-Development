<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Получить путь, на который пользователь должен быть перенаправлен, если он не аутентифицирован.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Если запрос ожидает JSON (например, для API), не перенаправляем.
        // В противном случае перенаправляем на страницу входа.
        if (! $request->expectsJson()) {
            return route('login');  // Редирект на маршрут входа
        }

        return null;  // В случае API, не перенаправляем
    }
}
