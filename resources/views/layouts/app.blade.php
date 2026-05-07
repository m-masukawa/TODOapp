<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Todoアプリ</title>
    <style>
        body { font-family: sans-serif; margin: 20px; line-height: 1.6; }
        nav { background: #f4f4f4; padding: 10px; margin-bottom: 20px; }
        nav a, nav button { margin-right: 15px; }
        .container { max-width: 800px; margin: 0 auto; }
        form { display: inline; }
        .error { color: red; }
    </style>
</head>
<body>
    <nav>
        @auth
            <span>こんにちは、{{ Auth::user()->name }} さん</span>
            <a href="{{ route('todos.index') }}">Todo一覧</a>
            <form method="POST" action="{{ route('logout') }}">
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