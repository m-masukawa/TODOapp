@extends('layouts.app') {{--「親」 --}}

@section('content') {{-- 中身 --}}

    <h1>Todo一覧</h1>

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