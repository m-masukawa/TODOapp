<?php

namespace App\Services;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoService
{
    public function create(array $data): Todo
    {
        return Todo::create([
            'title' => $data['title'],
            'body' => $data['body'] ?? null,
            'is_done' => false,
            'user_id' => Auth::id(),
        ]);
    }

    public function createTodo(array $data): Todo // 型を追加
    {
        return Todo::create($data);
    }
}