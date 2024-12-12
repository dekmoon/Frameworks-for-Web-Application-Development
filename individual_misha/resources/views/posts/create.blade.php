@extends('layouts.app')

@section('title', 'Создать пост')

@section('content')
    <div class="container">
        <h1>Создать новый пост</h1>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="news">Содержание</label>
                <textarea id="news" name="news" class="form-control" rows="5" required>{{ old('news') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection
