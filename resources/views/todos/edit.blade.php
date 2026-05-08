@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-4xl font-bold text-lcars-orange mb-8 underline">RECONFIGURE // DATA</h1>

    <form action="{{ route('todos.update', $todo) }}" method="POST" class="space-y-6">
        {{-- セキュリティのためのCSRFトークンを生成 --}}
        @csrf
        {{-- HTMLフォームでサポートされていないPUTメソッドを疑似的に使用 --}}
        @method('PUT')

        <div>
            <label>SYSTEM TITLE</label>
            {{-- 既存のデータを初期値として入力欄に表示 --}}
            <input type="text" name="title" value="{{ $todo->title }}">
        </div>

        <div>
            <label>DETAILS</label>
            {{-- 既存の詳細テキストをテキストエリアに表示 --}}
            <textarea name="body">{{ $todo->body }}</textarea>
        </div>

        <div class="flex gap-4 items-center mt-6">
            {{-- フォームの内容を送信するボタン --}}
            <button type="submit" class="btn-add">UPDATE SYSTEM</button>

            {{-- 処理を行わずに一覧画面へ戻るリンク --}}
            <a href="{{ route('todos.index') }}" class="btn-cancel-link">CANCEL</a>
        </div>
    </form>
</div>
@endsection