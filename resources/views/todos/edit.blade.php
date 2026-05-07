@extends('layouts.app')

@section('content')
    <h1>Todo編集</h1>
    <form action="{{ route('todos.update', $todo) }}" method="POST">
        @csrf
        @method('PUT') {{-- 更新はPUTを使います --}}
        <input type="text" name="title" value="{{ $todo->title }}" required>
        <textarea name="body">{{ $todo->body }}</textarea>
        <button type="submit">更新する</button>
        <a href="{{ route('todos.index') }}">キャンセル</a>
    </form>
@endsection