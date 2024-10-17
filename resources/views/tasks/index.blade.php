@extends('layouts.app')

@section('title', 'Список задач')

@section('content')
<h2>Задачи</h2>
<ul>
    @foreach ($tasks as $task)
    <li>
        <a href="{{ route('tasks.show', $task['id']) }}">{{ $task['title'] }}</a> - {{ $task['status'] }}
    </li>
    @endforeach
</ul>
@endsection
