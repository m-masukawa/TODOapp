@extends('layouts.app')

@section('content')
    <h2>Sign Up</h2>

    <form method="POST" action="{{ route('register.store') }}">
        {{-- セッションを保護するためのCSRFトークンを生成 --}}
        @csrf

        <div>
            <label>name</label><br>
            {{-- 直前の入力値を保持するold関数により利便性を向上 --}}
            <input type="text" name="name" value="{{ old('name') }}" required>
            {{-- 名前に関するエラーメッセージを表示 --}}
            @error('name') <p class="error">{{ $message }}</p> @enderror
        </div>
        <br>
        <div>
            <label>Email Address</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
            {{-- メールアドレスの一意性や形式に関するエラーを表示 --}}
            @error('email') <p class="error">{{ $message }}</p> @enderror
        </div>
        <br>
        <div>
            <label>Password</label><br>
            <input type="password" name="password" required>
            {{-- パスワードの最小文字数などのバリデーションエラーを表示 --}}
            @error('password') <p class="error">{{ $message }}</p> @enderror
        </div>
        <br>
        <div>
            <label>Confirm Password</label><br>
            {{-- 入力確認用。コントローラのconfirmedバリデーションと連動 --}}
            <input type="password" name="password_confirmation" required>
        </div>
        <br>
        <button type="submit">Register</button>
    </form>
@endsection