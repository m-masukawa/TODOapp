@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-lcars-orange mb-8 underline">MISSION</h1>
        
        <form action="{{ route('todos.store') }}" method="POST" class="mb-10 flex gap-2">
            @csrf
            <input type="text" name="title" class="bg-black border-2 border-lcars-orange p-2 flex-grow text-lcars-orange" placeholder="NEW COMMAND">
            <textarea name="body" placeholder="MISSION DETAILS"></textarea>
            <button type="submit" class="bg-lcars-orange text-black px-6 py-2 font-bold hover:bg-white">EXECUTE</button>
        </form>

        <ul class="space-y-4">
            @foreach ($todos as $todo)
            <li class="border-l-8 border-lcars-blue bg-gray-900 p-4 mb-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-xl font-bold text-lcars-blue">{{ $todo->title }}</span>
                    <div class="flex gap-4">
                        {{-- EDITをformタグに統一 --}}
                    <form action="{{ route('todos.edit', $todo) }}" method="GET">
                        <button type="submit" class="text-lcars-yellow">EDIT</button>
                    </form>

                    {{-- DELETEのformタグ --}}
                    <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="text-lcars-red">TERMINATE</button>
                    </form>
                    </div>
                </div>
                {{-- 詳細を表示！ --}}
                <!-- <div class="text-sm text-gray-300 lowercase">
                    DATA // {{ $todo->body }} 
                </div> -->
                        @if($todo->body)
                    <div class="text-sm text-gray-400 mt-2 lowercase" style="border-top: 1px solid #333; padding-top: 5px;">
                        <span class="text-lcars-orange">DETAILS //</span> {{ $todo->body }}
                    </div>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
@endsection