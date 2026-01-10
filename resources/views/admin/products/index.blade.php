@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')

<style>
/* ================= LAYOUT ================= */
.admin-wrapper {
    max-width: 1440px;
    margin: 0 auto;
}

/* ================= PAGE HEADER ================= */
.page-header h1 {
    font-weight: 700;
    color: #0f172a;
}

/* ================= FILTER ================= */
.filter-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #eef2f7;
    box-shadow: 0 10px 25px rgba(0,0,0,.04);
}

.filter-card .form-control,
.filter-card .form-select,
.filter-card .btn {
    height: 44px;
    border-radius: 10px;
}

/* ================= TABLE ================= */
.table-wrapper {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #eef2f7;
    box-shadow: 0 10px 25px rgba(0,0,0,.04);
}

.table-responsive {
    overflow-x: auto;
}

.table {
    min-width: 1100px;
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
    white-space: nowrap;
}

.table td {
    vertical-align: middle;
    white-space: nowrap;
}

/* ================= PRODUCT CELL ================= */
.product-cell {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 280px;
}

.product-img {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    object-fit: cover;
    border: 1px solid #e5e7eb;
    flex-shrink: 0;
}

.product-name {
    font-weight: 600;
    color: #0f172a;
    line-height: 1.2;
}

.product-desc {
    font-size: .8rem;
    color: #64748b;
}

/* ================= BADGE ================= */
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

/* ================= ACTION ================= */
.action-group {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
}

.action-btn {
    width: 36px;
    height: 36px;
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

/* ================= PAGINATION ================= */
.pagination {
    justify-content: center;
}
.pagination .page-link {
    border-radius: 10px;
    margin: 0 4px;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 992px) {
    .product-desc {
        display: none;
    }
}
</style>

<div class="container-fluid">
    <div class="admin-wrapper">

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

                    <div class="col-lg-5 col-md-6">
                        <label class="form-label fw-semibold">Cari Produk</label>
                        <input type="text" name="search" class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Masukkan nama produk...">
                    </div>

                    <div class="col-lg-4 col-md-6">
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

                    <div class="col-lg-3 d-flex gap-2">
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
                <table class="table table-hover align-middle mb-0">
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
                                <div class="product-cell">
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

                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.products.edit',$product->id) }}"
                                    class="action-btn action-edit">
                                        <i class="bi bi-pen-fill"></i>
                                    </a>

                                    <form action="{{ route('admin.products.destroy',$product->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-btn action-delete">
                                            <i class="bi bi-eraser"></i>
                                        </button>
                                    </form>
                                </div>
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
</div>
@endsection
