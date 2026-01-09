{{-- resources/views/admin/products/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0 text-gray-800 fw-bold">Tambah Produk Baru</h2>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Produk --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Produk</label>
                        <input type="text"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Contoh: Sepatu Futsal Adidas"
                               value="{{ old('name') }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">— Pilih Kategori —</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi Produk</label>
                        <textarea name="description"
                                  rows="4"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Tuliskan deskripsi produk secara lengkap...">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Harga --}}
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Harga Normal (Rp)</label>
                            <input type="number"
                                   name="price"
                                   class="form-control"
                                   placeholder="150000"
                                   value="{{ old('price') }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Harga Diskon (Rp)</label>
                            <input type="number"
                                   name="discount_price"
                                   class="form-control"
                                   placeholder="120000"
                                   value="{{ old('discount_price') }}">
                            <small class="text-muted">Kosongkan jika tidak ada diskon</small>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Stok</label>
                            <input type="number"
                                   name="stock"
                                   class="form-control"
                                   placeholder="10"
                                   value="{{ old('stock') }}">
                        </div>
                    </div>

                    {{-- Berat & Gambar --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Berat (Gram)</label>
                            <input type="number"
                                   name="weight"
                                   class="form-control"
                                   placeholder="500"
                                   value="{{ old('weight') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Upload Gambar Produk</label>
                            <input type="file"
                                   name="images[]"
                                   multiple
                                   class="form-control">
                            <small class="text-muted">Bisa upload lebih dari satu gambar</small>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input"
                               type="checkbox"
                               name="is_active"
                               value="1"
                               {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold">Produk Aktif</label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="bi bi-save"></i> Simpan Produk
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
