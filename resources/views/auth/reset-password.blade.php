@extends('layouts.app')

@section('title', 'Reset Password - LaravelApp')

@section('content')
    <div class="container pt-custom min-vh-100 d-flex align-items-center justify-content-center">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6 col-lg-5">

                <!-- Card Container -->
                <div class="card shadow-lg border-0 rounded-4 p-4 p-sm-5 bg-white bg-opacity-95">

                    <!-- Icon / Header -->
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fa-solid fa-lock-open fs-4"></i>
                        </div>
                        <h3 class="fw-bold text-dark">Reset Password</h3>
                        <p class="text-muted small mt-1">
                            Please enter your new password below to secure your account.
                        </p>
                    </div>

                    <!-- Form Reset Password -->
                    <form method="POST" action="{{ Route('password.update') }}">
                        @csrf

                        <!-- Password Reset Token (Hidden) -->
                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-secondary small">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control bg-light border-start-0 shadow-none @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email', request('email')) }}" placeholder="name@example.com" required autofocus>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block mt-1 small">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- New Password Input -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-secondary small">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" class="form-control bg-light border-start-0 shadow-none @error('password') is-invalid @enderror"
                                       id="password" name="password" placeholder="••••••••" required>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block mt-1 small">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold text-secondary small">Confirm New Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="fa-solid fa-shield-halved"></i>
                                </span>
                                <input type="password" class="form-control bg-light border-start-0 shadow-none"
                                       id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary py-2 rounded-pill fw-semibold shadow-sm">
                                <i class="fa-solid fa-rotate-right me-1"></i> Reset Password
                            </button>
                        </div>
                    </form>

                    <!-- Back to Login Link -->
                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-decoration-none small text-muted fw-semibold">
                            <i class="fa-solid fa-arrow-left me-1"></i> Back to Login
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
