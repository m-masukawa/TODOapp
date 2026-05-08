@extends('layouts.app')

@section('content')
    <h2>Login</h2>

    <form method="POST" action="{{ route('login.store') }}">
        {{-- CSRF攻撃を防ぐためのセキュリティトークンを発行 --}}
        @csrf

        <div>
            <label>Email Address</label><br>
            {{-- 入力エラー時に直前の入力内容を保持するold関数を使用 --}}
            <input type="email" name="email" value="{{ old('email') }}" required>
            {{-- メールアドレスに関するバリデーションエラーを表示 --}}
            @error('email') <p class="error">{{ $message }}</p> @enderror
        </div>
        <br>
        <div>
            <label>Password</label><br>
            <input type="password" name="password" required>
            {{-- パスワードに関するバリデーションエラーを表示 --}}
            @error('password') <p class="error">{{ $message }}</p> @enderror
        </div>
        <br>
        <button type="submit">Login</button>
    </form>
@endsection