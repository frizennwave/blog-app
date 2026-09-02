@extends('layouts.dashboard')

@section('title', $title)

@section('content')
    <section class="pt-custom pb-5">
        <div class="container-fluid px-4">
            <!-- Tombol Kembali -->
            <div class="mb-4">
                <a href="/users/trash" class="btn btn-outline-secondary px-3 py-2 rounded-pill shadow-sm d-inline-flex align-items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> <span>Kembali ke Sampah User</span>
                </a>
            </div>

            <!-- Card Detail Profile Sampah -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                        <!-- Banner / Header Card -->
                        <div class="bg-danger bg-opacity-10 p-4 text-center position-relative pt-5 pb-5">
                            <div class="position-absolute top-0 end-0 p-3">
                                <span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm">
                                    <i class="fa-solid fa-trash me-1"></i> Data Sampah
                                </span>
                            </div>

                            <!-- Avatar -->
                            <div class="position-relative d-inline-block mt-3">
                                <img src="{{ $user->profile->avatar ?? asset('images/default-avatar.png') }}"
                                     class="rounded-circle profile-pic border border-4 border-white shadow-sm"
                                     alt="Profile Picture"
                                     style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                        </div>

                        <!-- Body Card -->
                        <div class="card-body px-4 py-4 text-center">
                            <h3 class="fw-bold text-dark mb-1">{{ $user->username }}</h3>
                            <p class="text-muted fw-semibold mb-3">{{ $user->profile->name ?? 'Tanpa Nama' }}</p>

                            <!-- Aksi Tombol -->
                            <div class="d-flex justify-content-center gap-2 mb-4">
                                <button class="btn btn-outline-primary px-3 rounded-pill shadow-sm" disabled>
                                    <i class="fas fa-envelope me-1"></i> Message
                                </button>
                                @if (!empty($user->profile->website))
                                    <a href="{{ $user->profile->website }}" target="_blank" class="btn btn-primary px-3 rounded-pill shadow-sm">
                                        <i class="fa-solid fa-globe me-1"></i> Website
                                    </a>
                                @endif
                            </div>

                            <!-- Bio -->
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="p-3 bg-light rounded-4 text-secondary small">
                                        <p class="mb-0">{{ $user->profile->bio ?? 'Belum ada bio yang ditambahkan.' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
