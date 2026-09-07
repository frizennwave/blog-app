<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #4f46e5;
            --sidebar-bg: #ffffff;
            --body-bg: #f8fafc;
        }

        body {
            background-color: var(--body-bg);
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        /* Top Navbar */
        .navbar-dashboard {
            height: 70px;
            background: #ffffff;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            z-index: 1040; /* Navbar dibuat lebih tinggi dari sidebar */
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            position: fixed;
            top: 70px; /* Mulai tepat di bawah navbar (tinggi navbar 70px) */
            bottom: 0;
            left: 0;
            z-index: 1030;
            padding-top: 1.5rem;
            box-shadow: 1px 0 3px 0 rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-brand {
            width: var(--sidebar-width);
            height: 70px;
            background: #ffffff;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            border-right: 1px solid #f1f5f9;
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #64748b;
            padding: 10px 16px;
            border-radius: 10px;
            margin-bottom: 6px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link i {
            width: 24px;
            font-size: 1.1rem;
            margin-right: 12px;
            color: #94a3b8;
            transition: color 0.2s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #f1f5f9;
            color: #1e293b;
        }

        .sidebar .nav-link:hover i {
            color: var(--primary-color);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #4f46e5, #3b82f6);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        }

        .sidebar .nav-link.active i {
            color: #ffffff;
        }

        .sidebar-heading {
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #94a3b8;
            padding: 0 16px;
            margin-bottom: 8px;
            font-weight: 700;
            text-transform: uppercase;
        }

        /* Main Content Area */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: calc(70px + 2rem) 2rem 2rem 2rem; /* Menyesuaikan tinggi navbar agar konten tidak tertutup */
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                top: 0;
                padding-top: 86px;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
                padding: calc(70px + 1.5rem) 1rem 1rem 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dashboard fixed-top px-3 px-lg-4">
        <div class="container-fluid">
            <!-- Brand / Logo di dalam Navbar khusus untuk versi desktop sejajar dengan sidebar -->
            <div class="d-flex align-items-center">
                <!-- Sidebar Toggler untuk Mobile -->
                <button class="btn btn-light d-lg-none me-3 border-0 rounded-3 shadow-sm" type="button" id="sidebarToggle">
                    <i class="fa-solid fa-bars text-secondary"></i>
                </button>

                <a class="navbar-brand fw-bold d-none d-lg-flex align-items-center text-dark text-decoration-none me-0" href="/" style="width: calc(var(--sidebar-width) - 3rem);">
                    <img src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo"
                        width="32" height="26" class="me-2">
                    <span class="fs-5">Admin Panel</span>
                </a>
            </div>

            <!-- Logo untuk tampilan mobile -->
            <a class="navbar-brand fw-bold d-flex d-lg-none align-items-center text-dark text-decoration-none" href="/">
                <img src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo"
                    width="30" height="24" class="me-2">
                <span class="fs-6">Admin Panel</span>
            </a>

            <div class="ms-auto d-flex align-items-center">
                <!-- Dropdown Profil Pengguna -->
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center text-dark text-decoration-none bg-light px-3 py-2 rounded-pill shadow-sm" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if(auth()->user()->image->name && Storage::disk('public')->exists('images/' . auth()->user()->image->name))
                        <img src="{{ auth()->user()->image->name }}" alt="{{ $user->name }}" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                    @else
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 32px; height: 32px; font-size: 14px;">
                            {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                        </div>
                    @endif
                        <span class="fw-semibold small me-1">{{ auth()->user()->username }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 mt-2 py-2" style="min-width: 200px;">
                        <li><h6 class="dropdown-header text-muted small">Masuk sebagai {{ ucfirst(auth()->user()->role) }}</h6></li>
                        <li><a class="dropdown-item py-2 px-3 small fw-medium" href="{{ Route('detailUser', ['slug' => auth()->user()->slug]) }}"><i class="fa-solid fa-user-gear me-2 text-muted"></i> Profil Saya</a></li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li><a class="dropdown-item py-2 px-3 small fw-medium text-danger" href="/logout"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar Menu -->
    <nav id="sidebarMenu" class="sidebar px-3">
        <div class="position-sticky">
            <div class="sidebar-heading">Menu Utama</div>
            <ul class="nav flex-column mb-4 gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                        <i class="fa-solid fa-gauge"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('blog') || Route::is('detailBlog') || Route::is('trashBlog') || Route::is('detailTrashBlog') ? 'active' : '' }}" href="{{ Route('blog') }}">
                        <i class="fa-solid fa-newspaper"></i> Data Blog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('news') || Route::is('detailNews') || Route::is('trashNews') || Route::is('detailTrashNews') ? 'active' : '' }}" href="{{ Route('news') }}">
                        <i class="fa-solid fa-bullhorn"></i> Data News
                    </a>
                </li>
                @role('admin')
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('user') || Route::is('detailUser') || Route::is('trashUser') || Route::is('detailTrashUser') ? 'active' : '' }}" href="{{ Route('user') }}">
                            <i class="fa-solid fa-users"></i> Data User
                        </a>
                    </li>
                @endrole
            </ul>

            <div class="sidebar-heading">Sistem</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-muted" href="{{ Route('home') }}" target="_blank">
                        <i class="fa-solid fa-globe"></i> Lihat Website <i class="fa-solid fa-arrow-up-right-from-square ms-auto small text-muted"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Script tambahan untuk toggle sidebar di mobile -->
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebarMenu').classList.toggle('show');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
