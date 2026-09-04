@extends('layouts.app')

@section('title', $title)

@section('content')
    <section class="pt-custom pb-5">
        <div class="container-fluid px-4">
            <!-- Blog Post Container -->
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <!-- Tombol Kembali -->
                    <div class="mb-4">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-3 py-2 rounded-pill shadow-sm d-inline-flex align-items-center gap-2">
                            <i class="fa-solid fa-arrow-left"></i> <span>Kembali ke Blog</span>
                        </a>
                    </div>

                    <!-- Card Konten Utama -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-5">
                        <!-- Kategori -->
                        <div class="mb-3 d-flex flex-wrap gap-2">
                            @foreach ($blog->categories as $category)
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold">{{ $category->name }}</span>
                            @endforeach
                        </div>

                        <!-- Blog Post Title -->
                        <h1 class="fw-bold text-dark display-6 mb-3">{{ $blog->title }}</h1>

                        <!-- Meta Information -->
                        <div class="d-flex align-items-center text-muted small mb-4 pb-3 border-bottom gap-3">
                            <span><i class="fa-regular fa-user me-1"></i> By <strong>{{ $blog->user->profile->name }}</strong></span>
                            <span>•</span>
                            <span><i class="fa-regular fa-calendar me-1"></i> {{ $blog->created_at->format('d M Y') }}</span>
                        </div>

                        <!-- Blog Image (Ditambahkan di sini) -->
                        <div class="mb-4">
                            @if ($blog->image && Storage::disk('public')->exists('blog-images/' . $blog->image->name))
                                <img
                                    src="{{ Storage::disk('public')->url('blog-images/' . $blog->image->name) }}"
                                    class="img-fluid rounded-4 w-100 shadow-sm"
                                    alt="{{ $blog->title }}"
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
                            <button type="button" class="btn btn-primary px-3 py-2 rounded-pill shadow-sm d-inline-flex align-items-center gap-2" data-bs-toggle="modal"
                                data-bs-target="#addCommentModal">
                                <i class="fa-solid fa-pen"></i> <span>Tulis Komentar</span>
                            </button>
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

    <!-- Modal Tulis Komentar -->
    <div class="modal fade" id="addCommentModal" tabindex="-1" aria-labelledby="addCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0 px-4 pt-4">
                    <h5 class="modal-title fw-bold text-dark" id="addCommentModalLabel"><i class="fa-solid fa-pen text-primary me-2"></i>Tulis Komentar</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/comment" method="POST">
                    <div class="modal-body px-4">
                        <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                        <input type="hidden" name="slug" value="{{ $blog->slug }}">
                        <div class="mb-3">
                            <label for="comment" class="form-label fw-semibold small text-muted">Komentar:</label>
                            <textarea name="comment" class="form-control bg-light border-0" id="comment" rows="4" placeholder="Tulis tanggapan Anda..." required>{{ old('content') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Kirim Komentar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK',
                customClass: { confirmButton: 'btn btn-primary px-4 rounded-pill' },
                buttonsStyling: false
            });
        </script>
    @elseif ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi kesalahan',
                text: '{{ $errors->first() }}',
                confirmButtonText: 'OK',
                customClass: { confirmButton: 'btn btn-danger px-4 rounded-pill' },
                buttonsStyling: false
            });
        </script>
    @endif
@endsection
