@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-lcars-orange mb-8 underline">MISSION // TODOS</h1>
        
        <form action="{{ route('todos.store') }}" method="POST" class="mb-10 flex gap-2">
            @csrf
            <input type="text" name="title" class="bg-black border-2 border-lcars-orange p-2 flex-grow text-lcars-orange" placeholder="NEW COMMAND">
            <button type="submit" class="bg-lcars-orange text-black px-6 py-2 font-bold hover:bg-white">EXECUTE</button>
        </form>

        <ul class="space-y-4">
            @foreach ($todos as $todo)
                <li class="border-l-8 border-lcars-blue bg-gray-900 p-4 flex justify-between items-center">
                    <span class="text-xl">{{ $todo->title }}</span>
                    <div class="flex gap-4">
                        <a href="{{ route('todos.edit', $todo) }}" class="text-lcars-yellow">EDIT</a>
                        <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-lcars-red">TERMINATE</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection