<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Services\TodoService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    use AuthorizesRequests;

    private TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function index()
    {
        $todos = Auth::user()->todos; 
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        // 【重要】ログインユーザーのIDも一緒にServiceに渡す
        $this->todoService->create([
            'title'   => $request->input('title'),
            'body'    => $request->input('body'),
            'user_id' => Auth::id(), // ここを追加！
            'is_done' => false,
        ]);

        return redirect()->route('todos.index');
    }

    // 編集画面を表示
    public function edit(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) { abort(403); }
        return view('todos.edit', compact('todo'));
    }

    // 更新処理
    public function update(Request $request, Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) { abort(403); }

        $request->validate(['title' => 'required|max:255']);

        $todo->update([
            'title' => $request->title,
            'body'  => $request->body,
        ]);

        return redirect()->route('todos.index');
    }

    public function destroy(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        $todo->delete();

        return redirect()->route('todos.index');
    }
}