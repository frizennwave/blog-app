@extends('layouts.app')

@section('title', $title)

@section('content')
    <section class="pt-custom pb-5">
        <div class="container-fluid px-4">
            <!-- News Post Container -->
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <!-- Tombol Kembali -->
                    <div class="mb-4">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-3 py-2 rounded-pill shadow-sm d-inline-flex align-items-center gap-2">
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

                        <!-- News Image -->
                        <div class="mb-4">
                            @if ($news->image && Storage::disk('public')->exists('news-images/' . $news->image->name))
                                <img
                                    src="{{ Storage::disk('public')->url('blog-images/' . $news->image->name) }}"
                                    class="img-fluid rounded-4 w-100 shadow-sm"
                                    alt="{{ $news->title }}"
                                    style="max-height: 450px; object-fit: cover;"
                                >
                            @else
                                <div class="bg-light rounded-4 d-flex align-items-center justify-content-center text-muted" style="height: 300px;">
                                    <div class="text-center">
                                        <i class="fa-regular fa-image fa-3x mb-2"></i>
                                        <p class="mb-0">No Image Available</p>
                                    </div>
                                </div>
                            @endif
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
