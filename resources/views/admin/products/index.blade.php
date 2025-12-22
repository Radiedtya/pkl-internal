@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Daftar Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Produk
        </a>
    </div>

    {{-- Filter --}}
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">

                {{-- Search --}}
                <div class="col-md-5">
                    <label class="form-label fw-bold">Cari Produk</label>
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Nama produk..."
                           value="{{ request('search') }}">
                </div>

                {{-- Category --}}
                <div class="col-md-4">
                    <label class="form-label fw-bold">Kategori</label>
                    <select name="category" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Action --}}
                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary w-100">
                        Reset
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse($products as $product)
                            <tr>
                                <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>

                                {{-- Gambar Utama --}}
                                <td>
                                    @if($product->primaryImage)
                                        <img src="{{ asset('storage/' . $product->primaryImage->path) }}"
                                             class="rounded border"
                                             style="width:60px;height:60px;object-fit:cover;">
                                    @else
                                        <span class="text-muted small">No Image</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="fw-bold">{{ $product->name }}</div>
                                    <small class="text-muted">
                                        {{ Str::limit($product->description, 40) }}
                                    </small>
                                </td>

                                <td>{{ $product->category?->name }}</td>

                                <td>
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>

                                <td>
                                    <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>

                                {{-- Status --}}
                                <td>
                                    @if($product->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>

                                {{-- Action --}}
                                <td class="text-end">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    Produk tidak ditemukan
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $products->links() }}
    </div>

</div>
@endsection
