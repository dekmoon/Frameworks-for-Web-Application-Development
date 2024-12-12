<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>

<header>
    <div>
        <h1>Новостной блог Республики Молдова</h1>
    </div>
</header>

<main class="height">
    @yield('content')
</main>

<footer>
    <div>
        <strong>!Новость Месяца!</strong>
        <p>Преподаватель Гуцу поставил зачёт Вове Надулишняку ! СЕНСАЦИЯ !</p>
    </div>
</footer>

</body>
</html>
