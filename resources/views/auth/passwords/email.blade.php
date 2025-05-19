@extends('login')

@section('content1')
    <div
        style="position: fixed; left: 40%; border-radius: 5px; z-index: 9999; background: rgb(255, 255, 255); padding: 1rem; border: 1px solid rgb(255, 255, 255);">
        {{-- Debug marker --}}


        <h1>Reset Password</h1>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <input type="email" name="email" placeholder="Your email" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            <button type="submit">Send Reset Link</button>
        </form>
        <div class="options"
            style="margin-bottom: 1.5rem; display: flex; justify-content: flex-start; font-size: var(--menu-font-size);">
            <a href="{{ route('login') }}" style="color: var(--link-hover-color); text-decoration: none;">
                ← Back to Sign In
            </a>
        </div>
    </div>
@endsection