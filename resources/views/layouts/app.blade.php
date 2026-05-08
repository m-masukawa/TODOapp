<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Todo App</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="bg-lcars-bg text-white p-6">
    <nav class="flex gap-4 mb-8 bg-lcars-blue p-4 text-black font-bold rounded-full">
    @auth
        <span>LOGIN [{{ Auth::user()->name }}]</span>
        <a href="{{ route('todos.index') }}" class="hover:text-white">INDEX</a>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="hover:text-white">LOGOUT</button>
        </form>
    @else
        {{-- ログインしていない時はこっちを表示 --}}
        <span>GUEST // ACCESS DENIED</span>
        <a href="{{ route('login') }}" class="hover:text-white">LOGIN</a>
        <a href="{{ route('register') }}" class="hover:text-white">Sign Up</a>
    @endauth
</nav>
    
    @yield('content')
</body>
</html>