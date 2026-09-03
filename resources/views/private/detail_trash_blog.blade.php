@extends('layouts.dashboard')

@section('title', $title)

@section('content')
    <section class="pt-custom pb-5">
        <div class="container-fluid px-4">
            <!-- Blog Post Container -->
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <!-- Tombol Kembali -->
                    <div class="mb-4">
                        <a href="{{ route('trashBlog') }}" class="btn btn-outline-secondary px-3 py-2 rounded-pill shadow-sm d-inline-flex align-items-center gap-2">
                            <i class="fa-solid fa-arrow-left"></i> <span>Kembali ke Sampah Blog</span>
                        </a>
                    </div>

                    <!-- Card Konten Utama -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-5">
                        <!-- Peringatan Status Sampah -->
                        <div class="alert alert-warning bg-warning bg-opacity-10 border-0 text-warning-emphasis rounded-4 p-3 mb-4 d-flex align-items-center gap-3">
                            <i class="fa-solid fa-triangle-exclamation fs-4"></i>
                            <div class="small">
                                Artikel ini berada di dalam <strong>folder sampah</strong> dan tidak ditampilkan ke publik.
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div class="mb-3 d-flex flex-wrap gap-2">
                            @foreach ($blog->categories as $category)
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold">{{ $category->name }}</span>
                            @endforeach
                        </div>

                        <!-- Blog Post Title -->
                        <h1 class="fw-bold text-dark display-6 mb-3">{{ $blog->title }}</h1>

                        <!-- Meta Information -->
                        <div class="d-flex flex-wrap align-items-center text-muted small mb-4 pb-3 border-bottom gap-3">
                            <span><i class="fa-regular fa-user me-1"></i> By <strong>{{ $blog->user->profile->name }}</strong></span>
                            <span>•</span>
                            <span><i class="fa-regular fa-calendar me-1"></i> Dibuat: {{ $blog->created_at->format('d M Y') }}</span>
                            <span>•</span>
                            <span class="text-danger"><i class="fa-regular fa-trash-can me-1"></i> Dihapus: {{ $blog->deleted_at->format('d M Y') }}</span>
                        </div>

                        <!-- Blog Post Content -->
                        <div class="post-content text-secondary lh-lg mb-4">
                            <p style="white-space: pre-line;">{{ $blog->content }}</p>
                        </div>

                        <!-- Tags -->
                        <div class="pt-3 border-top d-flex flex-wrap align-items-center gap-2">
                            <span class="fw-semibold small text-muted me-1"><i class="fa-solid fa-tags me-1"></i> Tags:</span>
                            @foreach ($blog->tags as $tag)
                                <span class="badge bg-light text-secondary px-3 py-2 rounded-pill fw-normal">#{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Bagian Komentar -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                            <h4 class="fw-bold text-dark mb-0 fs-5"><i class="fa-regular fa-comments me-2 text-primary"></i>Komentar ({{ $blog->comment->count() }})</h4>
                        </div>

                        <div class="comment-list">
                            @forelse ($blog->comment as $comment)
                                <div class="card bg-light border-0 rounded-4 p-3 mb-3">
                                    <div class="d-flex align-items-start gap-3">
                                        <img class="rounded-circle shadow-sm"
                                            src="{{ asset('img/user.png') }}" alt="avatar" width="45"
                                            height="45" />
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <h6 class="fw-bold text-dark mb-0">Anonim</h6>
                                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="text-secondary small mb-2">{{ $comment->comment }}</p>
                                            <div class="d-flex align-items-center gap-3 fs-7 text-muted">
                                                <a href="#!" class="text-decoration-none text-muted fw-semibold">Remove</a>
                                                <span>•</span>
                                                <a href="#!" class="text-decoration-none text-muted fw-semibold">Reply</a>
                                                <span>•</span>
                                                <a href="#!" class="text-decoration-none text-muted fw-semibold">Translate</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4 text-muted">
                                    <i class="fa-regular fa-comment-dots fa-2x mb-2 d-block opacity-50"></i>
                                    <span>Belum ada komentar pada artikel ini.</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
