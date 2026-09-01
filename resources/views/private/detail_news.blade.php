@extends('layouts.app')

@section('title', $title)

@section('content')
    <!-- Blog Post Container -->
    <div class="container pt-custom">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <a href="{{ route('news') }}" class="btn btn-primary mb-3">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>

                <!-- Blog Post Title -->
                <h1 class="post-title">{{ $news->title }}</h1>

                <!-- Meta Information -->
                <p class="meta-info">By <strong>{{ $news->author }}</strong> | {{ $news->created_at->format('d-m-Y') }}</p>


                <!-- Blog Post Content -->
                <div class="post-content">
                    <p>{{ $news->content }}</p>
                </div>
            </div>

        </div>
    </div>
@endsection
