@extends('layouts.app')

@section('content')
<style>
    body {
        overflow: hidden; /* Menghilangkan scroll */
        background: #ccc2cca4;
    }
</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-6"> <!-- Ukuran card lebih kecil -->
        <div class="card shadow-lg border-0 rounded-4" style="background: linear-gradient(135deg, #FFDDE1, #F5C6D6); border-radius: 20px;">
            <div class="card-header text-center fw-bold" style="background-color: #A33757; color: white; border-top-left-radius: 20px; border-top-right-radius: 20px;">
                🔐 {{ __('Login ke LIS\' Modest Wear') }}
            </div>

            <div class="card-body p-4" style="background-color: #FFFBF2; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-2">
                        <label for="email" class="form-label fw-bold">
                            📧 {{ __('Email Address') }}
                        </label>
                        <input id="email" type="email" class="form-control rounded-pill @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Masukkan email kamu..." style="padding: 10px;">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>⚠️ {{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">
                            🔑 {{ __('Password') }}
                        </label>
                        <input id="password" type="password" class="form-control rounded-pill @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password"
                            placeholder="Masukkan password..." style="padding: 10px;">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>⚠️ {{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" 
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                             {{ __('Ingat Saya') }}
                        </label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn fw-bold text-white rounded-pill" style="background-color: #DC586D; padding: 10px;">
                             {{ __('Login') }}
                        </button>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-center mt-3">
                            <a class="btn btn-link text-decoration-none fw-bold" style="color: #A33757;" href="{{ route('password.request') }}">
                                ❓ {{ __('Lupa Password?') }}
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
