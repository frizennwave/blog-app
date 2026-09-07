@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container pt-custom min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary">Welcome Back</h3>
                        <p class="text-muted small">Silakan masuk ke akun Laravel kamu</p>
                    </div>

                    <!-- Alert Sukses (Contoh: Setelah Register Berhasil) -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3 small py-2 px-3 mb-3 shadow-sm position-relative pe-5 auto-close-alert" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-circle-check me-2"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                            <button type="button" class="btn-close position-absolute top-50 translate-middle-y end-0 me-3" style="font-size: 0.75rem;" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Session Status Alert -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show small" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Alert Gagal / Error Login -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 small py-2 px-3 mb-3 shadow-sm position-relative pe-5 auto-close-alert" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-triangle-exclamation me-2"></i>
                                <span>Email atau password yang kamu masukkan salah.</span>
                            </div>
                            <button type="button" class="btn-close position-absolute top-50 translate-middle-y end-0 me-3" style="font-size: 0.75rem;" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Form Login -->
                    <form action="" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label text-secondary small fw-semibold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-envelope text-muted"></i></span>
                                <!-- Diperbaiki dari email5 menjadi email -->
                                <input type="email" class="form-control bg-light border-start-0" id="email" name="email" placeholder="nama@example.com" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-secondary small fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-lock text-muted"></i></span>
                                <input type="password" class="form-control bg-light border-start-0" id="password" name="password" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label text-muted small" for="remember">Remember me</label>
                            </div>
                            <a href="{{ Route('password.request') }}" class="small link-grey">Lupa password?</a>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-2 fw-semibold rounded-3">Sign In</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="small text-muted">Belum punya akun? <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-semibold">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil semua elemen dengan class auto-close-alert
        let alertElements = document.querySelectorAll('.auto-close-alert');

        alertElements.forEach(function(alertElement) {
            // Set timer 4 detik untuk setiap alert yang muncul
            setTimeout(function() {
                let alert = new bootstrap.Alert(alertElement);
                alert.close();
            }, 4000);
        });
    });
</script>

@endsection
