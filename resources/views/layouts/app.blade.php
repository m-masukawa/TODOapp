<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Todo App</title>
    {{-- 外部スタイルシートを読み込み --}}
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="bg-lcars-bg text-white p-6">
    <nav class="flex gap-4 mb-8 bg-lcars-blue p-4 text-black font-bold rounded-full">
    {{-- 現在のユーザーが認証済み（ログイン中）かどうかを判定 --}}
    @auth
        {{-- 認証済みユーザーの名前を動的に取得して表示 --}}
        <span>LOGIN [{{ Auth::user()->name }}]</span>
        <a href="{{ route('todos.index') }}" class="hover:text-white">INDEX</a>
        {{-- ログアウト処理はセキュリティ保持のためPOSTメソッドで送信 --}}
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="hover:text-white">LOGOUT</button>
        </form>
    {{-- 認証されていない（ゲスト）ユーザー向けの表示 --}}
    @else
        <span>GUEST // ACCESS DENIED</span>
        <a href="{{ route('login') }}" class="hover:text-white">LOGIN</a>
        <a href="{{ route('register') }}" class="hover:text-white">Sign Up</a>
    @endauth
</nav>
    
    {{-- 各ページ固有のコンテンツがここに挿入される --}}
    @yield('content')
</body>
</html>