@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')

<style>
/* ===== PAGE ===== */
.page-header h1 {
    font-weight: 700;
    color: #0f172a;
}

/* ===== FILTER CARD ===== */
.filter-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #eef2f7;
    box-shadow: 0 10px 25px rgba(0,0,0,.04);
}

/* ===== TABLE ===== */
.table-wrapper {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #eef2f7;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,.04);
}

.table thead {
    background: #f8fafc;
}

.table th {
    font-size: .75rem;
    text-transform: uppercase;
    letter-spacing: .05em;
    color: #64748b;
    border-bottom: 1px solid #e5e7eb;
}

.table td {
    vertical-align: middle;
}

/* ===== PRODUCT ===== */
.product-img {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    object-fit: cover;
    border: 1px solid #e5e7eb;
}

.product-name {
    font-weight: 600;
    color: #0f172a;
}

.product-desc {
    font-size: .8rem;
    color: #64748b;
}

/* ===== BADGE ===== */
.badge-soft-success {
    background: #dcfce7;
    color: #166534;
}
.badge-soft-danger {
    background: #fee2e2;
    color: #991b1b;
}
.badge-soft-secondary {
    background: #e5e7eb;
    color: #374151;
}

/* ===== ACTION ===== */
.action-btn {
    border-radius: 10px;
    padding: 6px 10px;
}

/* ===== PAGINATION FIX ===== */
.pagination {
    justify-content: center;
}

.pagination svg {
    width: 16px !important;
    height: 16px !important;
}

.pagination .page-link {
    border-radius: 10px;
    margin: 0 4px;
    color: #0f172a;
}

.pagination .page-item.active .page-link {
    background: #2563eb;
    border-color: #2563eb;
    color: #fff;
}

.pagination .page-link:hover {
    background: #e5e7eb;
}

/* ===== FILTER SPACING FIX ===== */
.filter-card .card-body {
    padding: 24px 28px;
}

.filter-card .form-label {
    margin-bottom: 6px;
}

.filter-card .form-control,
.filter-card .form-select {
    height: 44px;
    border-radius: 10px;
}

.filter-card .btn {
    height: 44px;
    border-radius: 10px;
}

/* ===== ACTION ICON FIX ===== */
.action-btn {
    width: 36px;
    height: 36px;
    padding: 0;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.action-edit {
    border: 1px solid #2563eb;
    color: #2563eb;
}

.action-edit:hover {
    background: #2563eb;
    color: #fff;
}

.action-delete {
    border: 1px solid #dc2626;
    color: #dc2626;
}

.action-delete:hover {
    background: #dc2626;
    color: #fff;
}

</style>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Manajemen Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Produk
        </a>
    </div>

    {{-- FILTER --}}
    <div class="filter-card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">

                <div class="col-md-5">
                    <label class="form-label fw-semibold">Cari Produk</label>
                    <input type="text" name="search" class="form-control"
                           placeholder="Masukkan nama produk..."
                           value="{{ request('search') }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Kategori</label>
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

                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i> Terapkan
                    </button>
                    <a href="{{ route('admin.products.index') }}"
                       class="btn btn-outline-secondary w-100">
                        Reset
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="table-wrapper">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
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
                        <td class="text-muted">
                            {{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}
                        </td>

                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($product->primaryImage)
                                    <img src="{{ $product->primaryImage->image_url }}" class="product-img">
                                @else
                                    <div class="product-img d-flex align-items-center justify-content-center bg-light">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="product-name">{{ $product->name }}</div>
                                    <div class="product-desc">
                                        {{ Str::limit($product->description, 45) }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>{{ $product->category?->name ?? '-' }}</td>

                        <td class="fw-semibold">
                            Rp {{ number_format($product->price,0,',','.') }}
                        </td>

                        <td>
                            <span class="badge {{ $product->stock > 0 ? 'badge-soft-success' : 'badge-soft-danger' }}">
                                {{ $product->stock }}
                            </span>
                        </td>

                        <td>
                            <span class="badge {{ $product->is_active ? 'badge-soft-success' : 'badge-soft-secondary' }}">
                                {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>

                        <td class="text-end">
                            <a href="{{ route('admin.products.edit',$product->id) }}"
                            class="action-btn action-edit me-2"
                            title="Edit">
                                <i class="bi bi-pen-fill"></i>
                            </a>

                            <form action="{{ route('admin.products.destroy',$product->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="action-btn action-delete"
                                        title="Hapus">
                                    <i class="bi bi-eraser"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            Tidak ada produk ditemukan
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $products->links() }}
    </div>

</div>
@endsection
