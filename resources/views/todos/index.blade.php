@extends('layouts.app')

@section('content')
    <h2>Todo一覧</h2>
    
    <form action="{{ route('todos.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="タイトル" required>
        <button type="submit">追加</button>
    </form>

    <ul>
        @foreach ($todos as $todo)
            <li>{{ $todo->title }}</li>
        @endforeach
    </ul>
@endsection