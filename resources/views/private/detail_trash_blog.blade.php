@extends('layouts.app')

@section('title', $title)

@section('content')
    <!-- Blog Post Container -->
    <div class="container pt-custom">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <a href="{{ route('trashBlog') }}" class="btn btn-primary mb-3">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>

                <!-- Blog Post Title -->
                <h1 class="post-title">{{ $blog->title }}</h1>

                <!-- Meta Information -->
                <p class="delete-meta-info">By <strong>{{ $blog->author }}</strong> | {{ $blog->created_at->format('d-m-Y') }}</p>
                <p class="meta-info">Deleted at {{ $blog->deleted_at->format('d-m-Y') }}</p>

                <div class="row g-3 py-3">
                    @foreach ($blog->tags as $tag)
                        <div class="col-auto">
                            <span class="suggestion-tag">#{{ $tag->name }}</span>
                        </div>
                    @endforeach
                </div>

                <!-- Blog Post Content -->
                <div class="post-content">
                    {{-- <img src="https://via.placeholder.com/800x400" alt="Blog Image" class="img-fluid"> --}}

                    <p>{{ $blog->content }}</p>

                    {{-- <h2>1. Artificial Intelligence and Automation</h2>
                    <p>Artificial Intelligence (AI) has already begun transforming how websites and applications are built.
                        From chatbots to recommendation engines, AI is becoming more integrated into the user experience,
                        allowing for more personalized and efficient interactions.</p>

                    <h2>2. Progressive Web Apps (PWAs)</h2>
                    <p>Progressive Web Apps (PWAs) are web applications that use modern web technologies to provide a native
                        app-like experience. They’re fast, reliable, and can work offline, making them a popular choice for
                        developers looking to create cross-platform applications.</p>

                    <img src="https://via.placeholder.com/800x400" alt="PWA Illustration" class="img-fluid">

                    <h2>3. The Rise of Web 3.0</h2>
                    <p>Web 3.0 refers to the next generation of the internet, where decentralization and blockchain
                        technologies are key components. With Web 3.0, users can have more control over their data, and
                        decentralized applications (dApps) are becoming more mainstream.</p>

                    <p>These are just a few of the trends to watch out for in 2024. The world of web development is
                        constantly evolving, and staying ahead of the curve will help developers create more innovative and
                        impactful web experiences.</p> --}}

                </div>
            </div>

            <div class="container my-5 py-5 text-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 col-lg-10 col-xl-8">
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-4 border-2 border-bottom">
                            <h4 class="text-body mb-0">Comments ({{ $blog->comment->count() }})</h4>
                        </div>

                        @forelse ($blog->comment as $comment)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex flex-start">
                                        <img class="rounded-circle shadow-1-strong me-3"
                                            src="{{ asset('img/user.png') }}" alt="avatar"
                                            width="40" height="40" />
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="text-primary mb-0">
                                                    Anonym
                                                    <span class="text-body ms-2">{{ $comment->comment }}</span>
                                                </h6>
                                                <p class="mb-0">{{ $comment->created_at->diffForHumans() }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="small mb-0" style="color: #aaa;">
                                                    <a href="#!" class="link-grey">Remove</a> •
                                                    <a href="#!" class="link-grey">Reply</a> •
                                                    <a href="#!" class="link-grey">Translate</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card mb-3">
                                <div class="card-body text-center">
                                    No comments yet!
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
