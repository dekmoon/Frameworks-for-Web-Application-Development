@extends('layouts.app')

@section('title', 'Редактировать пост')

@section('content')
    <div class="container">
        <h1>Редактировать пост</h1>

        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
            </div>

            <div class="form-group">
                <label for="news">Содержание</label>
                <textarea id="news" name="news" class="form-control" rows="5" required>{{ old('news', $post->news) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Обновить</button>
        </form>
    </div>
@endsection
