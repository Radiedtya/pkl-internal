{{-- resources/views/admin/products/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0 text-gray-800 fw-bold">Edit Produk</h2>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <form action="{{ route('admin.products.update', $product->id) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nama Produk --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Produk</label>
                        <input type="text"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $product->name) }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">— Pilih Kategori —</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Harga --}}
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Harga Normal (Rp)</label>
                            <input type="number"
                                   name="price"
                                   class="form-control"
                                   value="{{ old('price', $product->price) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Harga Diskon (Rp)</label>
                            <input type="number"
                                   name="discount_price"
                                   class="form-control"
                                   value="{{ old('discount_price', $product->discount_price) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Stok</label>
                            <input type="number"
                                   name="stock"
                                   class="form-control"
                                   value="{{ old('stock', $product->stock) }}">
                        </div>
                    </div>

                    {{-- Berat & Gambar --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Berat (Gram)</label>
                            <input type="number"
                                   name="weight"
                                   class="form-control"
                                   value="{{ old('weight', $product->weight) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Upload Gambar Baru</label>
                            <input type="file"
                                   name="images[]"
                                   multiple
                                   class="form-control">
                            <small class="text-muted">
                                Upload jika ingin mengganti / menambah gambar
                            </small>
                        </div>
                    </div>

                    {{-- Preview Gambar Lama --}}
                    @if($product->images && $product->images->count())
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Gambar Saat Ini</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($product->images as $image)
                                    <img src="{{ $image->image_url }}"
                                         class="rounded border"
                                         style="width: 90px; height: 90px; object-fit: cover;">
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Status --}}
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input"
                               type="checkbox"
                               name="is_active"
                               value="1"
                               {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold">Produk Aktif</label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-warning btn-lg w-100">
                        <i class="bi bi-pencil-square"></i> Update Produk
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
