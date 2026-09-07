@extends('layouts.dashboard')

@section('title', $title)

@section('content')
    <section class="pt-custom pb-5">
        <div class="container-fluid px-4">
            <!-- Header Halaman -->
            <div class="d-flex flex-column justify-content-start gap-3 mb-4">
                <div class="mb-2">
                    <h1 class="h3 fw-bold text-dark mb-1">Data News</h1>
                    <p class="text-muted small mb-0">Kelola informasi berita, artikel, dan pembaruan sistem.</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-primary px-3 py-2 rounded-pill shadow-sm d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addNewsModal">
                        <i class="fa-solid fa-plus"></i> <span>Tambah News</span>
                    </button>
                    <a href="{{ route('trashNews') }}" class="btn btn-outline-danger px-3 py-2 rounded-pill shadow-sm d-inline-flex align-items-center gap-2">
                        <i class="fa-solid fa-trash"></i> <span>Sampah News</span>
                    </a>
                </div>
            </div>

            <!-- Card Tabel & Filter -->
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <!-- Form Pencarian -->
                <div class="row justify-content-between align-items-center mb-4">
                    <div class="col-auto">
                        <h5 class="fw-bold mb-0 text-secondary fs-6">
                            <i class="fa-solid fa-trash-arrow-up me-2 text-danger"></i>
                            Daftar News
                        </h5>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <form class="d-flex" method="GET">
                            <div class="input-group shadow-sm rounded-pill overflow-hidden bg-light">
                                <input name="title" class="form-control border-0 bg-transparent px-3 py-2 text-secondary" type="search" placeholder="Cari judul berita..."
                                    aria-label="Search" value="{{ $keyword }}" autofocus>
                                <button class="btn btn-primary px-4 border-0" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabel Data -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase fs-7 text-muted">
                            <tr>
                                <th scope="col" class="py-3 px-3 rounded-start" style="width: 5%;">No</th>
                                <th scope="col" class="py-3">Title</th>
                                <th scope="col" class="py-3 text-center" style="width: 15%;">Rating</th>
                                <th scope="col" class="py-3 text-center rounded-end" style="width: 20%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @forelse ($news as $item)
                                <tr>
                                    <th scope="row" class="px-3 text-secondary fw-semibold">{{ ($news->firstItem() ?? 0) + $loop->index }}</th>
                                    <td class="fw-semibold text-dark">{{ $item->title }}</td>
                                    <td class="text-center">
                                        <i class="fa-solid fa-star me-1 text-warning"></i> {{ number_format(collect($item->rating->pluck('rating_value'))->avg() ?? 0, 1) }}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <a href="{{ route('detailNews', ['slug' => $item->slug]) }}" class="text-primary" title="Detail">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </a>
                                            <button class="text-success bg-transparent border-0" data-bs-toggle="modal"
                                                data-bs-target="#updateNewsModal" data-slug="{{ $item->slug }}"
                                                data-title="{{ $item->title }}" data-author="{{ $item->author }}"
                                                data-content="{{ $item->content }}" data-status="{{ $item->status }}" onclick="fillModal(this)" title="Ubah">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                            <form action="{{ route('softDeleteNews', ['slug' => $item->slug]) }}" method="POST" class="d-inline form-delete">
                                                @method('DELETE')
                                                <button type="submit" class="text-danger bg-transparent border-0" title="Hapus">
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
                                        <span>Tidak ada data berita yang ditemukan.</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginasi -->
                <div class="mt-4 d-flex justify-content-end">
                    {{ $news->links() }}
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Tambah News -->
    <div class="modal fade" id="addNewsModal" tabindex="-1" aria-labelledby="addNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0 px-4 pt-4">
                    <h5 class="modal-title fw-bold text-dark" id="addNewsModalLabel"><i class="fa-solid fa-plus text-primary me-2"></i>Tambah News</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('createNews') }}" method="POST">
                    <div class="modal-body px-4">
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold small text-muted">Title:</label>
                            <input name="title" type="text" class="form-control bg-light border-0" id="title"
                                value="{{ old('title') }}" placeholder="Masukkan judul berita..." required>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label fw-semibold small text-muted">Author:</label>
                            <input name="author" type="text" class="form-control bg-light border-0" id="author"
                                value="{{ old('author') }}" placeholder="Nama penulis..." required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label fw-semibold small text-muted">Content:</label>
                            <textarea name="content" class="form-control bg-light border-0" id="content" rows="4" placeholder="Tulis konten berita..." required>{{ old('content') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold small text-muted">Status:</label>
                            <select name="status" id="status" class="form-select bg-light border-0">
                                <option value="" selected disabled>Pilih status publikasi</option>
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ubah News -->
    <div class="modal fade" id="updateNewsModal" tabindex="-1" aria-labelledby="updateNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0 px-4 pt-4">
                    <h5 class="modal-title fw-bold text-dark" id="updateNewsModalLabel"><i class="fa-regular fa-pen-to-square text-success me-2"></i>Ubah News</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="newsForm" action="" method="POST">
                    @method('PATCH')
                    <div class="modal-body px-4">
                        <div class="mb-3">
                            <label for="titleUpdate" class="form-label fw-semibold small text-muted">Title:</label>
                            <input name="title" type="text" class="form-control bg-light border-0" id="titleUpdate"
                                value="{{ old('title') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="authorUpdate" class="form-label fw-semibold small text-muted">Author:</label>
                            <input name="author" type="text" class="form-control bg-light border-0" id="authorUpdate"
                                value="{{ old('author') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="contentUpdate" class="form-label fw-semibold small text-muted">Content:</label>
                            <textarea name="content" class="form-control bg-light border-0" id="contentUpdate" rows="4" required>{{ old('content') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="statusUpdate" class="form-label fw-semibold small text-muted">Status:</label>
                            <select name="status" id="statusUpdate" class="form-select bg-light border-0">
                                <option value="" selected disabled>Pilih status publikasi</option>
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Save</button>
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
                    window.location.href = "{{ url('/admin/news') }}";
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
            document.getElementById('statusUpdate').value = btn.dataset.status;

            document.getElementById('newsForm').action = "/admin/news/" + btn.dataset.slug;
        }

        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Yakin?',
                    text: "Data akan dipindahkan ke sampah!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
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
