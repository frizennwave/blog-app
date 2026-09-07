@extends('layouts.app')

@section('title', 'Forgot Password - LaravelApp')

@section('content')
<div class="container pt-custom min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card shadow-lg border-0 rounded-4 p-4 p-sm-5 bg-white bg-opacity-95">

                <div class="text-center mb-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-key fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-dark">Forgot Password?</h3>
                    <p class="text-muted small mt-1">
                        No worries! Enter your email address and we will send you a link to reset your password.
                    </p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show small" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ Route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold text-secondary small">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control bg-light border-start-0 shadow-none @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autofocus>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block mt-1 small">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary py-2 rounded-pill fw-semibold shadow-sm">
                            <i class="fa-solid fa-paper-plane me-1"></i> Send Reset Link
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-decoration-none small text-muted fw-semibold">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Login
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Check Your Email',
        text: '{{ session("success") }}',
        confirmButtonColor: '#06b6d4'
    });
</script>
@endif
@endsection
