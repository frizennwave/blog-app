@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="bg-light pt-4 min-vh-100">
        <div class="container py-5">
            <div class="row">
                <!-- Profile Header -->
                <div class="col-12 mb-4">
                    <a href="/users/trash" class="btn btn-primary mb-3">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                    <div class="profile-header position-relative mb-4">
                        <div class="position-absolute top-0 end-0 p-3">
                            <button class="btn btn-light"><i class="fas fa-edit me-2"></i>Edit Profile</button>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="position-relative d-inline-block">
                            <img src="{{ $user->profile->avatar }}" class="rounded-circle profile-pic"
                                alt="Profile Picture">
                        </div>
                        <h3 class="mt-3 mb-1">{{ $user->username }}</h3>
                        <p class="text-muted mb-3">{{ $user->profile->name }}</p>
                        <div class="d-flex justify-content-center gap-2 mb-4">
                            <button class="btn btn-outline-primary"><i class="fas fa-envelope me-2"></i>Message</button>
                            <a href="{{ $user->profile->website }}" class="btn btn-primary"><i class="fa-solid fa-globe me-2"></i>Website</a>
                        </div>
                        <div class="d-flex justify-content-center gap-2 mb-4">
                            <p>{{ $user->profile->bio }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
