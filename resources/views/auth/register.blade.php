@extends('layouts.app')

@section('content')
    <h2>新規登録</h2>

    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <div>
            <label>名前</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <p class="error">{{ $message }}</p> @enderror
        </div>
        <br>
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
        <div>
            <label>パスワード（確認用）</label><br>
            <input type="password" name="password_confirmation" required>
        </div>
        <br>
        <button type="submit">登録する</button>
    </form>
@endsection