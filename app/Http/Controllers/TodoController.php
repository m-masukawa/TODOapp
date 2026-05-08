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

    // サービス層の依存注入および初期化
    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    // ログインユーザーに紐付いたTodo一覧の表示
    public function index()
    {
        // 未認証ユーザーをログイン画面へ強制リダイレクト
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 認証済みユーザーが所有するレコードのみを取得
        $todos = Auth::user()->todos; 
        return view('todos.index', compact('todos'));
    }

    // バリデーション実施後の新規データ作成
    public function store(Request $request)
    {
        // 必須項目および文字数制限の検証
        $request->validate([
            'title' => 'required|max:255',
        ]);

        // ログイン中のユーザーリレーションを経由してレコードを保存
        Auth::user()->todos()->create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('todos.index');
    }

    // 編集対象データの所有権確認および画面表示
    public function edit(Todo $todo)
    {
        // 他者のデータ操作を防止するためのアクセス拒否処理
        if ($todo->user_id !== Auth::id()) { abort(403); }
        
        return view('todos.edit', compact('todo'));
    }

    // 既存レコードの内容更新処理
    public function update(Request $request, Todo $todo)
    {
        // 更新実行前の所有権バリデーション
        if ($todo->user_id !== Auth::id()) { abort(403); }

        $request->validate(['title' => 'required|max:255']);

        // 指定されたカラムの値を新しい入力値で上書き
        $todo->update([
            'title' => $request->title,
            'body'  => $request->body,
        ]);

        return redirect()->route('todos.index');
    }

    // 指定されたレコードの物理削除
    public function destroy(Todo $todo)
    {
        // 削除実行前の所有権バリデーション
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        $todo->delete();

        return redirect()->route('todos.index');
    }
}