@extends('login')

@section('content')

    <div style="position: fixed; border-radius: 5px; z-index: 9999; background: rgb(255, 255, 255); padding: 1rem; border: 1px solid rgb(255, 255, 255);
                                                        left: 40%; ">

        <h2>
            Set a New Password
        </h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-group">
                <input class="form-control" type="email" name="email" value="{{ old('email', $email) }}" readonly
                    placeholder="Your email" />
                @error('email')
                    <div class="text-danger" style="font-size: 0.9rem; margin-top: 0.25rem;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div>
                <input class="form-control" type="password" name="password" placeholder="New password" required />
                @error('password')
                    <p class="text-danger mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>


            <div class="input-group">
                <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm password"
                    required />
            </div>

            <div class="options"
                style="margin-bottom: 1.5rem; display: flex; justify-content: flex-start; font-size: var(--menu-font-size);">
                <a href="{{ route('login') }}" style="color: var(--link-hover-color); text-decoration: none;">
                    ← Back to Sign In
                </a>
            </div>

            <button type="submit">
                Reset Password
            </button>
        </form>
    </div>
@endsection