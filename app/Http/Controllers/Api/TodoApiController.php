<?php

use Illuminate\Http\Request;
use App\Services\TodoService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TodoApiController extends Controller
{
    private TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function store(Request $request)
    {
        //データを受け取ってバリデーション
    $request->validate([
        'title' => 'required|max:255',
    ]);

    // 現在のユーザーのIDを取得してuser_idに設定
    $todo = $this->todoService->create(array_merge($request->all(), ['user_id' => Auth::id()]));

    return response()->json($todo, 201);
    }
}