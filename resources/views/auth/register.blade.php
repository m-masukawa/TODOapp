@extends('layouts.app')

@section('content')
    <h2>Sign Up</h2>

    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <div>
            <label>name</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <p class="error">{{ $message }}</p> @enderror
        </div>
        <br>
        <div>
            <label>Email Address</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <p class="error">{{ $message }}</p> @enderror
        </div>
        <br>
        <div>
            <label>Password</label><br>
            <input type="password" name="password" required>
            @error('password') <p class="error">{{ $message }}</p> @enderror
        </div>
        <br>
        <div>
            <label>Confirm Password</label><br>
            <input type="password" name="password_confirmation" required>
        </div>
        <br>
        <button type="submit">Register</button>
    </form>
@endsection