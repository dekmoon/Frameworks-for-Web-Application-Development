<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <!-- Подключаем Bootstrap из CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="text-center">
        <h1>Добро пожаловать на главную страницу!</h1>
        @if(auth()->check())
            <p class="mt-3">Привет, {{ auth()->user()->name }}! Вы вошли в систему.</p>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-danger">Выйти</button>
            </form>
        @else
            <p class="mt-3">Вы не вошли в систему.</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Вход</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Регистрация</a>
        @endif
    </div>
</div>

<!-- Подключаем Bootstrap JS и его зависимости (Popper.js и Bootstrap Bundle) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
