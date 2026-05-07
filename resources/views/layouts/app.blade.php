<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Todoアプリ</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        nav { background: #eee; padding: 10px; margin-bottom: 20px; display: flex; gap: 10px; }
    </style>
</head>
<body>
    <nav>
        @auth
            <span>こんにちは、{{ Auth::user()->name }} さん</span>
            <a href="{{ route('todos.index') }}">Todo一覧</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        @else
            <a href="{{ route('login') }}">ログイン</a>
            <a href="{{ route('register') }}">新規登録</a>
        @endauth
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>