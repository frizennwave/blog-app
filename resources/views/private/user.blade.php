@extends('layouts.app')

@section('title', $title)

@section('content')
    <section class="pt-custom">
        <div class="container">
            <h1 class="fs-2 mb-5">Data User</h1>

            <div class="row justify-content-end max-w-50">
                <div class="col-md-6">
                    {{-- <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addBlogModal">
                        <i class="fa-solid fa-plus"></i> Tambah User
                    </button> --}}
                    <a href="/users/trash" class="btn btn-danger mb-3">
                        <i class="fa-solid fa-trash"></i> Sampah User
                    </a>
                </div>
                <div class="col-md-6">
                    <form class="d-flex" method="GET">
                        <div class="input-group">
                            <input name="name" class="form-control form-control-md" type="search" placeholder="Search"
                                aria-label="Search" value="{{ $keyword }}" autofocus>
                            <button class="btn btn-primary px-4" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table w-100 table-hover table-striped mb-2">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 3%; white-space: nowrap;">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col"  class="hidden">Email</th>
                            <th scope="col" class="text-center text-nowrap actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @forelse ($users as $user)
                            <tr>
                                <th scope="row">{{ ($users->firstItem() ?? 0) + $loop->index }}</th>
                                <td>{{ $user->profile->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center text-nowrap">
                                    <a href="/user/{{ $user->slug }}" class="text-primary"><i
                                            class="fa-solid fa-circle-info"></i></a> |
                                    <form action="/user/{{ $user->slug }}" method="POST" class="d-inline form-delete">
                                        @method('DELETE')
                                        <button type="submit" class="text-danger border-0 bg-transparent px-0 btn-delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No data found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $users->links() }}
        </div>
    </section>

    {{-- <div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateBlogModal" tabindex="-1" aria-labelledby="updateBlogModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addBlogModalLabel">Ubah Blog</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="blogForm" action="" method="POST">
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="col-form-label">Title:</label>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('/users') }}";
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
        // function fillModal(btn) {
        //     document.getElementById('titleUpdate').value = btn.dataset.title;
        //     document.getElementById('authorUpdate').value = btn.dataset.author;
        //     document.getElementById('contentUpdate').value = btn.dataset.content;

        //     document.getElementById('blogForm').action = "/blog/" + btn.dataset.slug;
        // }

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
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
