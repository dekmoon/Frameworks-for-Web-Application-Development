@extends('layouts.app')

@section('title', 'Админ-панель')

@section('content')
    <h1>Панель администратора</h1>

    <a href="{{ route('posts.create') }}">Создать новый пост</a>

    <h2>Список пользователей</h2>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->name }} - {{ $user->email }} - Роль: {{ $user->role }}</li>
        @endforeach
    </ul>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Выйти</button>
    </form>
@endsection
