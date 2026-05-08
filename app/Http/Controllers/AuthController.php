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
    // 新規登録用の入力画面を表示
    public function showRegister(): View
    {
        return view('auth.register');
    }

    // ユーザー情報のバリデーションおよびデータベース登録
    public function register(Request $request): RedirectResponse
    {
        // 名前、メール、パスワードの形式と一意性をチェック
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // パスワードをハッシュ化して新しいユーザーレコードを作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 登録したユーザー情報でログイン状態を確立
        Auth::login($user);

        // 作成完了後にメインの一覧画面へ遷移
        return redirect()->route('todos.index');
    }

    // ログイン用の入力画面を表示
    public function showLogin(): View
    {
        return view('auth.login');
    }

    // 認証情報の照合およびログインセッションの開始
    public function login(Request $request): RedirectResponse
    {
        // 送信されたメールアドレスとパスワードの存在を確認
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // データベースの照合に成功した場合はセッションIDを更新
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('todos.index');
        }

        // 照合失敗時にエラーメッセージを付与して入力画面へ返却
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->onlyInput('email');
    }

    // 現在のログインセッションの破棄
    public function logout(Request $request): RedirectResponse
    {
        // ユーザーの認証状態を解除
        Auth::logout();

        // 既存セッションの破棄とCSRFトークンのリセット
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 処理終了後にログイン画面へ遷移
        return redirect()->route('login');
    }
}