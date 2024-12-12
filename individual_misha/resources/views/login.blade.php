@extends('layouts.app')

@section('title', 'Авторизация')

@section('content')
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="email">Email</label>
        <input style="width: 100%" type="email" id="email" name="email" placeholder="Введите свой email" required>
        <br>
        <label for="password">Пароль</label>
        <input style="width: 100%" type="password" id="password" name="password" placeholder="Введите пароль" required>
        <br>
        <button style="width: 100%" type="submit">Войти</button>
        <p>
            У вас нет аккаунта? - <a href="{{ route('register') }}">зарегистрируйтесь</a>!
        </p>
    </form>
@endsection

