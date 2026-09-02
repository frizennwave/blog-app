@extends('layouts.dashboard')

@section('title', $title)

@section('content')
    <section class="pt-custom pb-5">
        <div class="container-fluid px-4">
            <!-- Header Section dengan Desain Kartu Modern -->
            <div class="d-flex flex-column justify-content-start gap-3 mb-4">
                <div class="mb-2">
                    <h1 class="h3 fw-bold mb-1 text-dark">Manajemen Data Blog</h1>
                    <p class="text-muted small mb-0">Kelola artikel, publikasi, dan kategori blog dengan mudah di sini.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-primary px-3 py-2 rounded-pill shadow-sm d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addBlogModal">
                        <i class="fa-solid fa-plus-circle"></i> <span>Tambah Blog</span>
                    </button>
                    <a href="{{ route('trashBlog') }}" class="btn btn-outline-danger px-3 py-2 rounded-pill shadow-sm d-inline-flex align-items-center gap-2">
                        <i class="fa-solid fa-trash-arrow-up"></i> <span>Sampah Blog</span>
                    </a>
                </div>
            </div>

            <!-- Card Utama untuk Tabel & Filter -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-white border-0 p-4 pb-0">
                    <div class="row align-items-center justify-content-between g-3">
                        <div class="col-auto">
                            <h5 class="fw-bold mb-0 text-secondary fs-6"><i class="fa-solid fa-list-ul me-2 text-primary"></i>Daftar Artikel Blog</h5>
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
                                            <small class="text-muted"><i class="fa-regular fa-user me-1"></i> {{ $blog->author ?? 'Admin' }}</small>
                                        </td>
                                        <td class="text-center">
                                            @php $avgRating = collect($blog->rating->pluck('rating_value'))->avg() ?? 0; @endphp
                                            {{ number_format($avgRating, 1) }}
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-1">
                                                <a href="{{ route('detailBlog', ['slug' => $blog->slug]) }}" class=" text-info" title="Detail">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </a>
                                                <button class="text-success bg-transparent border-0" data-bs-toggle="modal"
                                                    data-bs-target="#updateBlogModal" data-slug="{{ $blog->slug }}"
                                                    data-title="{{ $blog->title }}" data-author="{{ $blog->author }}"
                                                    data-content="{{ $blog->content }}" data-tags="{{ $blog->tags->pluck('id')->implode(',') }}" onclick="fillModal(this)" title="Edit">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <form action="{{ route('softDeleteBlog', ['slug' => $blog->slug]) }}" method="POST" class="d-inline form-delete">
                                                    @method('DELETE')
                                                    <button type="submit" class="text-danger bg-transparent border-0 btn-delete" title="Hapus">
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
                                            <span>Tidak ada data blog yang ditemukan.</span>
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

    <!-- Modal Tambah Blog -->
    <div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0 px-4 pt-4">
                    <h5 class="modal-title fw-bold text-dark" id="addBlogModalLabel"><i class="fa-solid fa-plus-circle text-primary me-2"></i>Tambah Blog Baru</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('createBlog') }}" method="POST">
                    <div class="modal-body px-4">
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold small text-muted">Title Artikel:</label>
                            <input name="title" type="text" class="form-control bg-light border-0 py-2" id="title"
                                value="{{ old('title') }}" placeholder="Masukkan judul blog..." required>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label fw-semibold small text-muted">Author:</label>
                            <input name="author" type="text" class="form-control bg-light border-0 py-2" id="author"
                                value="{{ old('author') }}" placeholder="Nama penulis..." required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label fw-semibold small text-muted">Content:</label>
                            <textarea name="content" class="form-control bg-light border-0" id="content" rows="4" placeholder="Tulis isi konten blog..." required>{{ old('content') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-muted d-block">Pilih Tags:</label>
                            <div class="d-flex flex-wrap gap-2 p-3 bg-light rounded-3">
                                @foreach ($tags as $key => $tag)
                                <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="addTag{{ $key }}">
                                    <label class="form-check-label small text-secondary" for="addTag{{ $key }}">{{ $tag->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Simpan Blog</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Blog -->
    <div class="modal fade" id="updateBlogModal" tabindex="-1" aria-labelledby="updateBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0 px-4 pt-4">
                    <h5 class="modal-title fw-bold text-dark" id="updateBlogModalLabel"><i class="fa-regular fa-pen-to-square text-success me-2"></i>Ubah Data Blog</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="blogForm" action="" method="POST">
                    @method('PATCH')
                    <div class="modal-body px-4">
                        <div class="mb-3">
                            <label for="titleUpdate" class="form-label fw-semibold small text-muted">Title Artikel:</label>
                            <input name="title" type="text" class="form-control bg-light border-0 py-2" id="titleUpdate"
                                value="{{ old('title') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="authorUpdate" class="form-label fw-semibold small text-muted">Author:</label>
                            <input name="author" type="text" class="form-control bg-light border-0 py-2" id="authorUpdate"
                                value="{{ old('author') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="contentUpdate" class="form-label fw-semibold small text-muted">Content:</label>
                            <textarea name="content" class="form-control bg-light border-0" id="contentUpdate" rows="4" required>{{ old('content') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-muted d-block">Pilih Tags:</label>
                            <div class="d-flex flex-wrap gap-2 p-3 bg-light rounded-3">
                                @foreach ($tags as $key => $tag)
                                <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input update-tag" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="updateTag{{ $key }}">
                                    <label class="form-check-label small text-secondary" for="updateTag{{ $key }}">{{ $tag->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Perbarui Data</button>
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
        function fillModal(btn) {
            document.getElementById('titleUpdate').value = btn.dataset.title;
            document.getElementById('authorUpdate').value = btn.dataset.author;
            document.getElementById('contentUpdate').value = btn.dataset.content;

            document.getElementById('blogForm').action = "/admin/blog/" + btn.dataset.slug;

            const tags = btn.dataset.tags.split(',');

            document.querySelectorAll('.update-tag').forEach(checkbox => {
                checkbox.checked = tags.includes(checkbox.value);
            });
        }

        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Yakin?',
                    text: "Data akan dipindahkan ke sampah!",
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
    </script>
@endsection
