@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    <div class="container pt-custom pb-5">

        {{-- Header --}}
        <div class="row mb-4">
            <div class="col">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <h1 class="fw-bold mb-1">Blog</h1>
                        <p class="text-muted mb-0">
                            Temukan berbagai artikel menarik di sini.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Category Filter --}}
        <div class="mb-4">
            <div class="d-flex flex-wrap gap-2">
                {{-- Semua --}}
                <a href="{{ route('public_blog') }}" class="btn {{ !$category ? 'btn-primary' : 'btn-outline-primary' }}">Semua</a>

                {{-- Categories --}}
                @foreach ($categories as $item)
                    <a href="{{ route('public_blog', ['category' => $item->slug]) }}" class="btn {{ $category === $item->slug ? 'btn-primary' : 'btn-outline-primary' }}">
                        {{ $item->name }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Blog List --}}
        <div class="row g-4">
            @forelse ($blogs as $blog)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden">

                        {{-- Image --}}
                        @if ($blog->image && Storage::disk('public')->exists('images/' . $blog->image->name))
                            <img
                                src="{{ Storage::disk('public')->url('images/' . $blog->image->name) }}"
                                class="card-img-top"
                                alt="{{ $blog->title }}"
                                style="height: 220px; object-fit: cover;"
                            >
                        @else
                            <div
                                class="bg-light d-flex align-items-center justify-content-center"
                                style="height: 220px;"
                            >
                                <div class="text-center text-muted">
                                    <i class="fa-regular fa-image fa-3x mb-2"></i>
                                    <p class="mb-0">No Image</p>
                                </div>
                            </div>
                        @endif

                            <div class="card-body d-flex flex-column">

                            {{-- Title --}}
                            <h5 class="card-title fw-bold mb-2">
                                {{ $blog->title }}
                            </h5>

                            {{-- Author --}}
                            <div class="text-muted small mb-1">
                                <i class="fa-regular fa-user me-1"></i>
                                {{ $blog->user->profile->name }}
                            </div>

                            @if ($blog->rating->count() < 1)
                                <div class="text-muted small mb-3">
                                    <i class="fa-regular fa-star me-1"></i>
                                    0
                                </div>
                            @else
                                <div class="text-muted small mb-3">
                                    <i class="fa-regular fa-star me-1"></i>
                                    {{ collect($blog->rating->pluck('rating_value'))->avg() }}
                                </div>
                            @endif

                            @if ($blog->categories->count() >= 1)
                                <div class="row g-3 py-3">
                                    <div class="col-auto">
                                        @foreach ($blog->categories as $category)
                                            <span class="suggestion-tag">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Content --}}
                            <p class="card-text text-muted">
                                {{ Str::limit(strip_tags($blog->content), 120) }}
                            </p>

                            {{-- Action --}}
                            <div class="mt-auto pt-3">
                                <a
                                    href="{{ Route('detailBlog', $blog->slug) }}"
                                    class="btn btn-outline-primary w-100"
                                >
                                    Baca Selengkapnya
                                    <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fa-regular fa-newspaper fa-4x text-muted mb-3"></i>

                        <h4 class="fw-bold">
                            Belum Ada Blog
                        </h4>

                        <p class="text-muted mb-0">
                            Belum ada artikel yang tersedia saat ini.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($blogs->hasPages())
            <div class="mt-5">
                {{ $blogs->links() }}
            </div>
        @endif

    </div>
@endsection
