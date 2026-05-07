@extends('layouts.app')

@section('content')
    <h2>ログイン</h2>

    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <div>
            <label>メールアドレス</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <p class="error">{{ $message }}</p> @enderror
        </div>
        <br>
        <div>
            <label>パスワード</label><br>
            <input type="password" name="password" required>
            @error('password') <p class="error">{{ $message }}</p> @enderror
        </div>
        <br>
        <button type="submit">ログインする</button>
    </form>
@endsection