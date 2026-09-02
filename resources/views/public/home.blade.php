@extends('layouts.app')

@section('title', $title)

@section('content')
    <section class="hero d-flex align-items-center text-white pt-mobile-6 position-relative overflow-hidden">
        <!-- Efek Background Glow / Ornamen Modern -->
        <div class="position-absolute top-0 start-50 translate-middle-x w-100 h-100 pointer-events-none" style="background: radial-gradient(circle at 50% 20%, rgba(255, 255, 255, 0.15) 0%, transparent 60%); z-index: 1;"></div>

        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center g-5">

                <!-- Text -->
                <div class="col-lg-6 text-center text-lg-start">
                    <div class="d-inline-flex align-items-center home-suggestion-tag shadow-sm mb-3">
                        <span class="me-2">🔥</span>
                        <span class="fw-semibold small text-dark">Platform Blog & News Terintegrasi</span>
                    </div>

                    <h1 class="display-4 fw-bold mb-3 mt-2 text-white tracking-tight">
                        Publikasi Konten <br class="d-none d-lg-inline">Lebih Cepat & <span class="text-warning">Powerful</span> 🚀
                    </h1>

                    <p class="lead mb-4 text-white-50 fs-6 lh-base">
                        Kelola artikel blog, berita terkini, dan manajemen pengguna dalam satu dashboard Laravel yang modern, aman, dan responsif.
                    </p>

                    <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-2">
                        <a href="{{ route('public_blog') }}" class="btn btn-light btn-lg px-4 py-3 fw-semibold rounded-pill shadow-sm d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-newspaper me-2 text-primary"></i> Jelajahi Blog
                        </a>
                        <a href="{{ route('public_news') }}" class="btn btn-outline-light btn-lg px-4 py-3 fw-semibold rounded-pill d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-bullhorn me-2"></i> Baca News
                        </a>
                    </div>

                    <!-- Mini Highlight Fitur -->
                    <div class="row mt-5 pt-3 border-top border-light border-opacity-10 text-start g-3">
                        <div class="col-4">
                            <h4 class="fw-bold mb-0 text-white">24+</h4>
                            <p class="small text-white-50 mb-0">Published Blog</p>
                        </div>
                        <div class="col-4">
                            <h4 class="fw-bold mb-0 text-white">12+</h4>
                            <p class="small text-white-50 mb-0">Active News</p>
                        </div>
                        <div class="col-4">
                            <h4 class="fw-bold mb-0 text-white">1.2K+</h4>
                            <p class="small text-white-50 mb-0">Community</p>
                        </div>
                    </div>
                </div>

                <!-- Image / Mockup Modern Card -->
                <div class="col-lg-6 text-center">
                    <div class="position-relative">
                        <!-- Card Dekoratif Mengambang (Floating Badge) -->
                        <div class="position-absolute top-0 start-0 translate-middle-y bg-white text-dark p-3 rounded-4 shadow-lg d-none d-sm-flex align-items-center gap-3 border border-light" style="z-index: 3;">
                            <div class="bg-success bg-opacity-10 p-2 rounded-3 text-success">
                                <i class="fa-solid fa-shield-halved fa-lg"></i>
                            </div>
                            <div class="text-start">
                                <h6 class="mb-0 fw-bold small">Sistem Aman</h6>
                                <p class="mb-0 text-muted" style="font-size: 11px;">Laravel Authenticated</p>
                            </div>
                        </div>

                        <!-- Gambar Utama dengan Efek Shadow & Border Radius Mewah -->
                        <div class="p-2 bg-white bg-opacity-10 rounded-4 shadow-lg backdrop-blur">
                            <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3" class="img-fluid rounded-4 w-100 object-fit-cover shadow"
                                alt="Hero Dashboard Mockup" style="max-height: 420px;">
                        </div>

                        <!-- Card Dekoratif Mengambang Bawah -->
                        <div class="position-absolute bottom-0 end-0 translate-middle-y bg-white text-dark p-3 rounded-4 shadow-lg d-none d-sm-flex align-items-center gap-3 border border-light" style="z-index: 3; margin-right: -20px;">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary">
                                <i class="fa-solid fa-bolt fa-lg"></i>
                            </div>
                            <div class="text-start">
                                <h6 class="mb-0 fw-bold small">Super Cepat</h6>
                                <p class="mb-0 text-muted" style="font-size: 11px;">Powered by Bootstrap 5</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
