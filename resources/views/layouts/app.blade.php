<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .hero {
            min-height: 100vh;
background: linear-gradient(135deg, #0f172a, #06b6d4);
        }

        .hero img {
            max-height: 500px;
        }

        .home-suggestion-tag {
            background: rgba(240, 240, 240, 0.9);
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            color: #555;
            transition: all 0.3s ease;
            border: 1px solid #ddd;
        }

        .pt-custom {
            padding-top: 6rem;
        }

        .post-title {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .meta-info {
            color: #6c757d;
            margin-bottom: 20px;
        }

        .delete-meta-info {
            color: #6c757d;
            margin-bottom: 7px;
        }

        .post-content img {
            max-width: 100%;
            border-radius: 10px;
            margin: 20px 0;
        }

        .post-content h2 {
            font-size: 2rem;
            margin-top: 30px;
        }

        .post-content p {
            line-height: 1.8;
            margin-top: 15px;
        }

        .actions {
            width: 9%;
        }

        .profile-sidebar {
            background: linear-gradient(135deg, #4158D0 0%, #C850C0 100%);
        }

        .profile-header {
            background: linear-gradient(135deg, #4158D0 0%, #C850C0 100%);
            height: 150px;
            border-radius: 15px;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border: 4px solid #fff;
            margin-top: -60px;
            background-color: #fff;
        }

        .link-grey {
            color: #aaa;
            text-decoration: none;
        }

        .link-grey:hover {
            color: #00913b;
        }

        .suggestion-tag {
            background: rgba(240, 240, 240, 0.9);
            padding: 8px 15px;
            border-radius: 25px;
            font-size: 13px;
            color: #555;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .suggestion-tag:hover {
            background: #0d6efd;
            color: #fff;
            transform: translateY(-3px);
        }

        @media (max-width: 576px) {
            .pt-mobile-6 {
                padding-top: 12rem;
            }

            .suggestion-tag,
            .home-suggestion-tag {
                font-size: 12px;
                padding: 6px 13px;
            }

            .actions {
                width: 30%;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm position-fixed w-100 z-3">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
                <img src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo"
                    width="30" height="24" class="d-inline-block align-text-top me-2">
                <span>LaravelApp</span>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <a class="nav-link px-3 rounded-pill {{ Route::is('home') ? 'active fw-semibold bg-primary bg-opacity-10 text-primary' : '' }}" href="{{ Route('home') }}">Home</a>
                    <a class="nav-link px-3 rounded-pill {{ Route::is('public_blog') || Route::is('detailPublicBlog') ? 'active fw-semibold bg-primary bg-opacity-10 text-primary' : '' }}"
                        href="{{ Route('public_blog') }}">Blog</a>
                    <a class="nav-link px-3 rounded-pill {{ Route::is('public_news') || Route::is('detailPublicNews') ? 'active fw-semibold bg-primary bg-opacity-10 text-primary' : '' }}"
                        href="{{ Route('public_news') }}">News</a>

                    @guest
                        <a class="btn btn-primary btn-sm px-4 rounded-pill ms-lg-2 mt-2 mt-lg-0 text-white fw-semibold"
                            href="{{ Route('login') }}">
                            <i class="fa-solid fa-right-to-bracket me-1"></i> Login
                        </a>
                    @endguest

                    @auth
                        <a class="btn btn-primary btn-sm px-4 rounded-pill ms-lg-2 mt-2 mt-lg-0 text-white fw-semibold"
                            href="{{ Route('dashboard') }}">
                            <i class="fa-solid fa-house-chimney me-1"></i> Dasboard
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
</body>

</html>
