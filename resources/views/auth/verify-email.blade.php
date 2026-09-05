@extends('layouts.app')

@section('title', 'Verifikasi Email')

@section('content')
<div class="container pt-custom min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <div class="bg-primary bg-opacity-15 text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fa-solid fa-envelope-circle-check fs-2"></i>
                        </div>
                        <h3 class="fw-bold text-primary">Cek Email Kamu</h3>
                        <p class="text-muted small px-2">
                            Sebelum melanjutkan, mohon verifikasi email kamu melalui tautan yang telah kami kirimkan. Jika kamu tidak menerima email tersebut, silakan klik tombol di bawah untuk mengirim ulang.
                        </p>
                    </div>

                    @if (session('message') == 'Verification link sent!')
                        <div class="alert alert-success alert-dismissible fade show rounded-3 small py-2 px-3 mb-3 shadow-sm position-relative pe-5 auto-close-alert" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-circle-check me-2"></i>
                                <span>Tautan verifikasi baru telah dikirim ke alamat email kamu.</span>
                            </div>
                            <button type="button" class="btn-close position-absolute top-50 translate-middle-y end-0 me-3" style="font-size: 0.75rem;" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Form Kirim Ulang Email Verifikasi -->
                    <form method="POST" action="{{ Route('verification.send') }}" class="mb-3">
                        @csrf
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-2 fw-semibold rounded-3">Kirim Ulang Email Verifikasi</button>
                        </div>
                    </form>

                    <!-- Tombol Logout / Keluar -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link text-muted text-decoration-none small">
                            <i class="fa-solid fa-arrow-right-from-bracket me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let alertElements = document.querySelectorAll('.auto-close-alert');

        alertElements.forEach(function(alertElement) {
            setTimeout(function() {
                let alert = new bootstrap.Alert(alertElement);
                alert.close();
            }, 4000);
        });
    });
</script>
@endsection
