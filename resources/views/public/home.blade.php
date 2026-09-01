@extends('layouts.app')

@section('title', $title)

@section('content')
    <section class="hero d-flex align-items-center text-white pt-mobile-6">
        <div class="container">
            <div class="row align-items-center">

                <!-- Text -->
                <div class="col-lg-6 text-center text-lg-start">
                    <span class="home-suggestion-tag">🔥 Pilih aplikasi terbaik</span>
                    <h1 class="display-4 fw-bold mb-3 mt-4">
                        Build Better Apps Faster 🚀
                    </h1>
                    <p class="lead mb-4">
                        Solusi modern untuk membantu kamu membuat aplikasi lebih cepat, scalable, dan powerful.
                    </p>

                    <a href="#" class="btn btn-light btn-lg me-2">
                        Get Started
                    </a>
                    <a href="#" class="btn btn-outline-light btn-lg">
                        Learn More
                    </a>
                </div>

                <!-- Image -->
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3" class="img-fluid rounded"
                        alt="Hero Image">
                </div>

            </div>
        </div>
    </section>
@endsection
