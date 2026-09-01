@extends('layouts.app')

@section('title', $title)

@section('content')
    <section class="pt-custom">
        <div class="container">
            <h1 class="fs-2 mb-5">Data News</h1>

            <div class="row justify-content-end max-w-50">
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addNewsModal">
                        <i class="fa-solid fa-plus"></i> Tambah News
                    </button>
                    <a href="{{ route('trashNews') }}" class="btn btn-danger mb-3">
                        <i class="fa-solid fa-trash"></i> Sampah News
                    </a>
                </div>
                <div class="col-md-6">
                    <form class="d-flex" method="GET">
                        <div class="input-group">
                            <input name="title" class="form-control form-control-md" type="search" placeholder="Search"
                                aria-label="Search" value="{{ $keyword }}" autofocus>
                            <button class="btn btn-primary px-4" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <table class="table w-100 table-hover table-striped mb-2">
                <thead>
                    <tr>
                        <th scope="col" style="width: 3%; white-space: nowrap;">No</th>
                        <th scope="col">Title</th>
                        <th scope="col" class="text-center text-nowrap actions">Rating</th>
                        <th scope="col" class="text-center text-nowrap actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @forelse ($news as $item)
                        <tr>
                            <th scope="row">{{ ($news->firstItem() ?? 0) + $loop->index }}</th>
                            <td>{{ $item->title }}</td>
                            <td class="text-center">{{ collect($item->rating->pluck('rating_value'))->avg() ?? 0 }}</td>
                            <td class="text-center">
                                <a href="{{ route('detailNews', ['slug' => $item->slug]) }}" class="text-primary"><i
                                        class="fa-solid fa-circle-info"></i></a> |
                                <button class="text-success border-0 bg-transparent px-0" data-bs-toggle="modal"
                                    data-bs-target="#updateNewsModal" data-slug="{{ $item->slug }}"
                                    data-title="{{ $item->title }}" data-author="{{ $item->author }}"
                                    data-content="{{ $item->content }}" data-status="{{ $item->status }}" onclick="fillModal(this)"><i
                                        class="fa-regular fa-pen-to-square"></i></button> |
                                <form action="{{ route('softDeleteNews', ['slug' => $item->slug]) }}" method="POST" class="d-inline form-delete">
                                    @method('DELETE')
                                    <button type="submit" class="text-danger border-0 bg-transparent px-0 btn-delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No data found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $news->links() }}
        </div>
    </section>

    <div class="modal fade" id="addNewsModal" tabindex="-1" aria-labelledby="addNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addNewsModalLabel">Tambah News</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('createNews') }}" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="col-form-label">Title:</label>
                            <input name="title" type="text" class="form-control" id="title"
                                value="{{ old('title') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="col-form-label">Author:</label>
                            <input name="author" type="text" class="form-control" id="author"
                                value="{{ old('author') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="col-form-label">Content:</label>
                            <textarea name="content" class="form-control" id="content" required>{{ old('content') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="col-form-label">Status:</label>
                            <select name="status" id="status" class="form-select">
                                <option value="" selected>Open this select menu</option>
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateNewsModal" tabindex="-1" aria-labelledby="updateNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateNewsModalLabel">Ubah News</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="newsForm" action="" method="POST">
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="titleUpdate" class="col-form-label">Title:</label>
                            <input name="title" type="text" class="form-control" id="titleUpdate"
                                value="{{ old('title') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="col-form-label">Author:</label>
                            <input name="author" type="text" class="form-control" id="authorUpdate"
                                value="{{ old('author') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="col-form-label">Content:</label>
                            <textarea name="content" class="form-control" id="contentUpdate" required>{{ old('content') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="col-form-label">Status:</label>
                            <select name="status" id="statusUpdate" class="form-select">
                                <option value="" selected>Open this select menu</option>
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
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
                confirmButtonText: 'OK'
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
                confirmButtonText: 'OK'
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
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#0d6efd',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // lanjut delete
                    }
                });
            });
        });
    </script>
@endsection
