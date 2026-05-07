@extends('layouts.app')

@section('title', $title)

@section('content')
    <section class="pt-custom">
        <div class="container">
            <h1 class="fs-2 mb-5">Sampah User</h1>

            <div class="row justify-content-end max-w-50">
                <div class="col-md-6">
                    <a href="/users" class="btn btn-primary mb-3">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
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
                            <th scope="col" class="hidden">Email</th>
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
                                    <a href="/user/trash/{{ $user->slug }}" class="text-primary">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a> |
                                    <a href="/user/restore/{{ $user->slug }}" class="text-success btn-restore">
                                        <i class="fa-solid fa-trash-arrow-up"></i>
                                    </a> |
                                    <form action="/user/delete/{{ $user->slug }}" method="POST"
                                        class="d-inline form-delete">
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
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Yakin?',
                    text: "Data akan dihapus permanen!",
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

        document.querySelectorAll('.btn-restore').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); //

                const url = this.getAttribute('href');

                Swal.fire({
                    title: 'Yakin?',
                    text: 'Data akan dipulihkan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#0d6efd',
                    confirmButtonText: 'Ya, pulihkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
@endsection
