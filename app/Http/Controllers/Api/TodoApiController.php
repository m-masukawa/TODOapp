<?php

use Illuminate\Http\Request;
use App\Services\TodoService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TodoApiController extends Controller
{
    private TodoService $todoService;

    // サービス層のインスタンスをプロパティにセット
    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    // 新規Todoの保存およびレスポンスの返却
    public function store(Request $request)
    {
        // 入力値の必須チェックと文字数制限
        $request->validate([
            'title' => 'required|max:255',
        ]);

        // 入力データと認証ユーザーIDを統合して保存処理を実行
        $todo = $this->todoService->create(array_merge($request->all(), ['user_id' => Auth::id()]));

        // 保存済みデータをJSON形式で返却し作成成功を通知
        return response()->json($todo, 201);
    }
}