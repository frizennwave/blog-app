@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold text-dark mb-1">Dashboard Overview</h1>
        @role('admin')
            <p class="text-muted small mb-0">Selamat datang kembali, Administrator! Berikut ringkasan aktivitas sistem Anda.</p>
        @endrole
        @role('editor')
        <p class="text-muted small mb-0">Selamat datang kembali, {{ auth()->user()->username }}! Berikut ringkasan aktivitas sistem Anda.</p>
        @endrole
    </div>
    <div>
        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold small">
            <i class="fa-solid fa-calendar-days me-1"></i> {{ date('d M Y') }}
        </span>
    </div>
</div>

@if (session('error'))
    <div id="alert-error" class="alert alert-danger">
        {{ session('error') }}
    </div>

    <script>
        // Tunggu hingga halaman selesai dimuat
        document.addEventListener("DOMContentLoaded", function() {
            const alertBox = document.getElementById('alert-error');

            if (alertBox) {
                // Set waktu 3000 milidetik (3 detik) sebelum hilang
                setTimeout(function() {
                    // Tambahkan efek transisi halus (fade out)
                    alertBox.style.transition = "opacity 0.5s ease";
                    alertBox.style.opacity = "0";

                    // Hapus elemen dari dokumen setelah transisi selesai
                    setTimeout(() => alertBox.remove(), 500);
                }, 3000);
            }
        });
    </script>
@endif

<!-- Quick Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-3 text-primary">
                    <i class="fa-solid fa-newspaper fa-xl"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="text-muted mb-1 small fw-semibold">Total Blog Posts</h6>
                    <h3 class="fw-bold mb-0 text-dark">24</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 bg-success bg-opacity-10 p-3 rounded-3 text-success">
                    <i class="fa-solid fa-bullhorn fa-xl"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="text-muted mb-1 small fw-semibold">Total News</h6>
                    <h3 class="fw-bold mb-0 text-dark">12</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 bg-warning bg-opacity-10 p-3 rounded-3 text-warning">
                    <i class="fa-solid fa-users fa-xl"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="text-muted mb-1 small fw-semibold">Registered Users</h6>
                    <h3 class="fw-bold mb-0 text-dark">1,280</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Section -->
<div class="row g-4">
    <!-- Recent Activity Table -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-dark mb-0">Aktivitas Terbaru</h5>
                <a href="#" class="small text-primary text-decoration-none fw-semibold">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 rounded-start small text-secondary">Modul</th>
                            <th class="py-3 small text-secondary">Judul / Keterangan</th>
                            <th class="py-3 rounded-end small text-secondary">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1">Blog</span></td>
                            <td class="fw-semibold small text-dark">Cara Mudah Belajar Laravel 11 untuk Pemula</td>
                            <td class="text-muted small">Baru saja</td>
                        </tr>
                        <tr>
                            <td class="py-3"><span class="badge bg-success bg-opacity-10 text-success px-2 py-1">News</span></td>
                            <td class="py-3 fw-semibold small text-dark">Update Fitur Terbaru Bootstrap 5.3</td>
                            <td class="py-3 text-muted small">2 jam lalu</td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1">User</span></td>
                            <td class="fw-semibold small text-dark">User baru mendaftar (Alexandria)</td>
                            <td class="text-muted small">Kemarin</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <h5 class="fw-bold text-dark mb-3">Aksi Cepat</h5>
            <div class="d-grid gap-2">
                <a href="{{ route('blog') }}" class="btn btn-outline-primary text-start py-2 px-3 rounded-3 d-flex align-items-center justify-content-between">
                    <span class="small fw-semibold"><i class="fa-solid fa-plus me-2"></i> Tambah Blog Baru</span>
                    <i class="fa-solid fa-chevron-right small"></i>
                </a>
                <a href="{{ route('news') }}" class="btn btn-outline-success text-start py-2 px-3 rounded-3 d-flex align-items-center justify-content-between">
                    <span class="small fw-semibold"><i class="fa-solid fa-plus me-2"></i> Tambah News Baru</span>
                    <i class="fa-solid fa-chevron-right small"></i>
                </a>
                <a href="{{ route('user') }}" class="btn btn-outline-secondary text-start py-2 px-3 rounded-3 d-flex align-items-center justify-content-between">
                    <span class="small fw-semibold"><i class="fa-solid fa-user-gear me-2"></i> Kelola User</span>
                    <i class="fa-solid fa-chevron-right small"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
