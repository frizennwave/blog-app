@extends('layouts.app')

@section('title', $title)

@section('content')
    <section class="pt-custom">
        <div class="container">
            <h1 class="fs-2 mb-5">Data Blog</h1>

            <div class="row justify-content-end max-w-50">
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addBlogModal">
                        <i class="fa-solid fa-plus"></i> Tambah Blog
                    </button>
                    <a href="/blog/trash" class="btn btn-danger mb-3">
                        <i class="fa-solid fa-trash"></i> Sampah Blog
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
                        <th scope="col" class="text-center text-nowrap actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @forelse ($blogs as $blog)
                        <tr>
                            <th scope="row">{{ ($blogs->firstItem() ?? 0) + $loop->index }}</th>
                            <td>{{ $blog->title }}</td>
                            <td class="text-center">
                                <a href="/blog/{{ $blog->slug }}" class="text-primary"><i
                                        class="fa-solid fa-circle-info"></i></a> |
                                <button class="text-success border-0 bg-transparent px-0" data-bs-toggle="modal"
                                    data-bs-target="#updateBlogModal" data-slug="{{ $blog->slug }}"
                                    data-title="{{ $blog->title }}" data-author="{{ $blog->author }}"
                                    data-content="{{ $blog->content }}" data-tags="{{ $blog->tags->pluck('id')->implode(',') }}" onclick="fillModal(this)"><i
                                        class="fa-regular fa-pen-to-square"></i></button> |
                                <form action="/blog/{{ $blog->slug }}" method="POST" class="d-inline form-delete">
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

            {{ $blogs->links() }}
        </div>
    </section>

    <div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addBlogModalLabel">Tambah Blog</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/blog/create" method="POST">
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
                            <label for="tags" class="col-form-label">Tags:</label>
                            <div class="input-group mb-3">
                                @foreach ($tags as $key => $tag)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="addTag{{ $key }}">
                                    <label class="form-check-label me-3" for="addTag{{ $key }}">{{ $tag->name }}</label>
                                </div>
                                @endforeach
                            </div>
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

    <div class="modal fade" id="updateBlogModal" tabindex="-1" aria-labelledby="updateBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateBlogModalLabel">Ubah Blog</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="blogForm" action="" method="POST">
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
                            <label for="tags" class="col-form-label">Tags:</label>
                            <div class="input-group mb-3">
                                @foreach ($tags as $key => $tag)
                                <div class="form-check">
                                    <input class="form-check-input update-tag" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="updateTag{{ $key }}">
                                    <label class="form-check-label me-3" for="updateTag{{ $key }}">{{ $tag->name }}</label>
                                </div>
                                @endforeach
                            </div>
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
                    window.location.href = "{{ url('/blog') }}";
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

            document.getElementById('blogForm').action = "/blog/" + btn.dataset.slug;

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
