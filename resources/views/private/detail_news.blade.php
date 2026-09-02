@extends('layouts.dashboard')

@section('title', $title)

@section('content')
    <section class="pt-custom pb-5">
        <div class="container-fluid px-4">
            <!-- News Post Container -->
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <!-- Tombol Kembali -->
                    <div class="mb-4">
                        <a href="{{ route('news') }}" class="btn btn-outline-secondary px-3 py-2 rounded-pill shadow-sm d-inline-flex align-items-center gap-2">
                            <i class="fa-solid fa-arrow-left"></i> <span>Kembali ke Berita</span>
                        </a>
                    </div>

                    <!-- Card Konten Utama -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-5">
                        <!-- Kategori -->
                        <div class="mb-3 d-flex flex-wrap gap-2">
                            @foreach ($news->categories as $category)
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold">{{ $category->name }}</span>
                            @endforeach
                        </div>

                        <!-- News Post Title -->
                        <h1 class="fw-bold text-dark display-6 mb-3">{{ $news->title }}</h1>

                        <!-- Meta Information -->
                        <div class="d-flex align-items-center text-muted small mb-4 pb-3 border-bottom gap-3">
                            <span><i class="fa-regular fa-user me-1"></i> By <strong>{{ $news->author ?? 'Admin' }}</strong></span>
                            <span>•</span>
                            <span><i class="fa-regular fa-calendar me-1"></i> {{ $news->created_at->format('d M Y') }}</span>
                        </div>

                        <!-- News Post Content -->
                        <div class="post-content text-secondary lh-lg mb-4">
                            <p style="white-space: pre-line;">{{ $news->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
