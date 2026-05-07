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
            <li>
    {{ $todo->title }}
    
    {{-- 削除ボタンのフォーム --}}
    <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE') {{-- ← これが「削除」であることをLaravelに伝える魔法の言葉 --}}
        <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
    </form>

      <a href="{{ route('todos.edit', $todo) }}">編集</a>

  </li>

        @endforeach
    </ul>

@endsection