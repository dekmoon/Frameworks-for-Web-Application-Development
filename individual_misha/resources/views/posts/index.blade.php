@extends('layouts.app')

@section('title', 'Новости')

@section('content')
    <h1>Новости</h1>

    @if(auth()->check() && auth()->user()->isAdmin())
        <div class="admin-button-div">
        <a class="admin-button" href="{{ route('admin') }}">Перейти в админ-панель</a>
        </div>
    @endif

    @foreach($posts as $post)
        <div class="post">
            <h2>{{ $post->title }}</h2>
            <p>Автор: {{ $post->author->name }}</p>
            <p>{{ $post->news }}</p>

            @if(auth()->check() && auth()->user()->isAdmin())
                <div class="admin-actions">
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Редактировать</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            @endif
        </div>
        <hr>
    @endforeach

    <form action="{{ route('logout') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit" class="btn btn-logout">Выйти</button>
    </form>
@endsection
