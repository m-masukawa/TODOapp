@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-4xl font-bold text-lcars-orange mb-8 underline">RECONFIGURE // DATA</h1>

    <form action="{{ route('todos.update', $todo) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label>SYSTEM TITLE</label>
            <input type="text" name="title" value="{{ $todo->title }}">
        </div>

        <div>

        <label>DETAILS</label>
    <textarea name="body">{{ $todo->body }}</textarea>
        </div>

            <div class="flex gap-4 items-center mt-6">
            {{-- 更新ボタン --}}
            <button type="submit" class="btn-add">UPDATE SYSTEM</button>

            {{-- キャンセルボタン --}}
            <a href="{{ route('todos.index') }}" class="btn-cancel-link">CANCEL</a>
        </div>
    </form>
</div>
@endsection