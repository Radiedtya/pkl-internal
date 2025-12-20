@extends('layouts.admin')

@section('title', 'Kategori')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Kategori</h1>
            <!-- Konten Kategori di sini -->
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-pen me-1"></i> Ubah
                                        </a>

                                        <form action="#" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                            @csrf
                                            @method('DELETE')

                                            <button class="dropdown-item" type="submit">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada kategori tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection

{{-- <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>

                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('buku.edit', $b->id) }}">
                                                    <i class="bi bi-pen me-1"></i> Ubah
                                                </a>

                                                <a class="dropdown-item" href="{{ route('buku.show', $b->id) }}">
                                                    <i class="bi bi-clipboard2 me-1"></i> Lihat
                                                </a>

                                                <form action="{{ route('buku.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="dropdown-item" type="submit">
                                                        <i class="bi bi-trash me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td> --}}