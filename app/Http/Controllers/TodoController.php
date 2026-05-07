<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Services\TodoService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // トレイトをインポート

class TodoController extends Controller
{
    use AuthorizesRequests; // トレイトを使用

    private TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function index()
    {
        $todos = Todo::latest()->get();
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        // TodoServiceを使ってTodoを作成
        $this->todoService->create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'is_done' => false,
        ]);

        return redirect()->route('todos.index');
    }

    public function update(Request $request, Todo $todo)
    {
        $this->authorize('update', $todo);

        $todo->update([
            'title' => $request->input('title'),
        ]);

        return redirect()->route('todos.index');
    }
}