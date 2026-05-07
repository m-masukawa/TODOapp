<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * 新規登録画面を表示
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * 新規登録処理
     */
    public function register(Request $request): RedirectResponse
    {
        // 1. バリデーション（入力チェック）
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // 2. ユーザー作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // パスワードを暗号化
        ]);

        // 3. ログインさせる
        Auth::login($user);

        // 4. Todo一覧へ移動
        return redirect()->route('todos.index');
    }

    /**
     * ログイン画面を表示
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * ログイン処理
     */
    public function login(Request $request): RedirectResponse
    {
        // 入力チェック
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // ログイン試行
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // セッションの再生成（セキュリティ対策）

            return redirect()->route('todos.index');
        }

        // 失敗した場合はエラーを返して戻る
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->onlyInput('email');
    }

    /**
     * ログアウト処理
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate(); // セッションを無効化
        $request->session()->regenerateToken(); // CSRFトークンを再生成

        return redirect()->route('login');
    }
}