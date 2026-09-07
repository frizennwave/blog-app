@extends('layouts.dashboard')

@section('title', $title)

@section('content')
    <section class="pt-custom pb-5">
        <div class="container-fluid px-4">
            <!-- Header Section dengan Desain Kartu Modern -->
            <div class="mb-4">
                <h1 class="h3 fw-bold mb-1 text-dark">Sampah Blog</h1>
                <p class="text-muted small mb-0">Kelola dan pulihkan artikel blog yang telah dihapus.</p>
            </div>
            <div class="mb-4">
                <a href="{{ route('blog') }}" class="btn btn-outline-secondary px-3 py-2 rounded-pill shadow-sm d-inline-flex align-items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> <span>Kembali ke Blog</span>
                </a>
            </div>

            <!-- Card Utama untuk Tabel & Filter -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-white border-0 p-4 pb-0">
                    <div class="row align-items-center justify-content-between g-3">
                        <div class="col-auto">
                            <h5 class="fw-bold mb-0 text-secondary fs-6"><i class="fa-solid fa-trash-arrow-up me-2 text-danger"></i>Daftar Sampah Blog</h5>
                        </div>
                        <div class="col-md-4">
                            <form class="d-flex" method="GET">
                                <div class="input-group input-group-sm">
                                    <input name="title" class="form-control rounded-start-pill ps-3 bg-light border-0" type="search" placeholder="Cari judul blog..."
                                        aria-label="Search" value="{{ $keyword }}" autofocus>
                                    <button class="btn btn-primary rounded-end-pill px-3" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body px-4 py-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-uppercase fs-7 text-muted">
                                <tr>
                                    <th scope="col" class="py-3 ps-3" style="width: 5%;">No</th>
                                    <th scope="col" class="py-3">Title & Informasi</th>
                                    <th scope="col" class="py-3 text-center" style="width: 15%;">Rating</th>
                                    <th scope="col" class="py-3 text-center" style="width: 15%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($blogs as $blog)
                                    <tr>
                                        <th scope="row" class="ps-3 text-muted fw-semibold">{{ ($blogs->firstItem() ?? 0) + $loop->index }}</th>
                                        <td>
                                            <span class="fw-semibold text-dark d-block">{{ $blog->title }}</span>
                                            <small class="text-muted"><i class="fa-regular fa-user me-1"></i> {{ $blog->user->profile->name }}</small>
                                        </td>
                                        <td class="text-center">
                                            @php $avgRating = collect($blog->rating->pluck('rating_value'))->avg() ?? 0; @endphp
                                            {{ number_format($avgRating, 1) }}
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-1">
                                                <a href="{{ route('detailTrashBlog', ['slug' => $blog->slug]) }}" class="text-info text-decoration-none px-2 py-1" title="Detail">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </a>
                                                <a href="{{ route('restoreBlog', ['slug' => $blog->slug]) }}" class="text-success text-decoration-none px-2 py-1 btn-restore" title="Pulihkan">
                                                    <i class="fa-solid fa-trash-arrow-up"></i>
                                                </a>
                                                <form action="{{ route('deleteBlog', ['slug' => $blog->slug]) }}" method="POST" class="d-inline form-delete">
                                                    @method('DELETE')
                                                    <button type="submit" class="text-danger bg-transparent border-0 px-2 py-1 btn-delete" title="Hapus Permanen">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="fa-regular fa-folder-open fa-2x mb-2 d-block opacity-50"></i>
                                            <span>Tidak ada data sampah blog yang ditemukan.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-white border-0 px-4 py-3">
                    <div>
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK',
                customClass: { confirmButton: 'btn btn-primary px-4 rounded-pill' },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('/admin/blog') }}";
                }
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

    <script>
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Yakin?',
                    text: "Data akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-danger px-4 rounded-pill me-2',
                        cancelButton: 'btn btn-secondary px-4 rounded-pill'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        document.querySelectorAll('.btn-restore').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const url = this.getAttribute('href');

                Swal.fire({
                    title: 'Yakin?',
                    text: 'Data akan dipulihkan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, pulihkan!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-success px-4 rounded-pill me-2',
                        cancelButton: 'btn btn-secondary px-4 rounded-pill'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
@endsection
