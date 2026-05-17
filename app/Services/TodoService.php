<?php

namespace App\Services;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoService
{
    // 入力データを受け取り認証ユーザーに関連付けて保存
    public function create(array $data): Todo
    {
        return Todo::create([
            'title' => $data['title'],
            'body' => $data['body'] ?? null,
            'is_done' => false,
            'user_id' => Auth::id(),
        ]);
    }

    // 指定された配列データをそのままデータベースに登録
    public function createTodo(array $data): Todo
    {
        return Todo::create($data);
    }
}