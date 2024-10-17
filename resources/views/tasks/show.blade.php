@extends('layouts.app')

@section('title', 'Детали задачи')

@section('content')
<h2>{{ $task['title'] }}</h2>
<p><strong>Описание:</strong> {{ $task['description'] }}</p>
<p><strong>Статус:</strong> {{ $task['status'] }}</p>
<p><strong>Приоритет:</strong> {{ $task['priority'] }}</p>
<p><strong>Назначено:</strong> {{ $task['assigned_to'] }}</p>
@endsection
