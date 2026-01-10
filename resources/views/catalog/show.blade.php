{{-- ================================================
     FILE: resources/views/catalog/show.blade.php
     FUNGSI: Halaman detail produk (Enhanced UI)
     ================================================ --}}

@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container py-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4 small">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('catalog.index') }}">Katalog</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('catalog.index', ['category' => $product->category->slug]) }}">
                    {{ $product->category->name }}
                </a>
            </li>
            <li class="breadcrumb-item active">{{ Str::limit($product->name, 30) }}</li>
        </ol>
    </nav>

    <div class="row g-5">

        {{-- IMAGE SECTION --}}
        <div class="col-lg-6">
            <div class="product-image-wrapper">

                {{-- Discount --}}
                @if($product->has_discount)
                    <span class="discount-badge">
                        -{{ $product->discount_percentage }}%
                    </span>
                @endif

                {{-- Main Image --}}
                <img src="{{ $product->image_url }}"
                     id="main-image"
                     class="product-main-image"
                     alt="{{ $product->name }}">

                {{-- Thumbnails --}}
                @if($product->images->count() > 1)
                    <div class="product-thumbnails">
                        @foreach($product->images as $image)
                            <img src="{{ asset('storage/'.$image->image_path) }}"
                                 onclick="document.getElementById('main-image').src = this.src">
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- INFO SECTION --}}
        <div class="col-lg-6">

            {{-- Category --}}
            <a href="{{ route('catalog.index', ['category' => $product->category->slug]) }}"
               class="product-category">
                {{ $product->category->name }}
            </a>

            {{-- Title --}}
            <h1 class="product-title">{{ $product->name }}</h1>

            {{-- Price --}}
            <div class="product-price mb-3">
                @if($product->has_discount)
                    <span class="price-old">
                        {{ $product->formatted_original_price }}
                    </span>
                @endif
                <span class="price-final">
                    {{ $product->formatted_price }}
                </span>
            </div>

            {{-- Stock --}}
            <div class="mb-4">
                @if($product->stock > 10)
                    <span class="badge bg-success">
                        <i class="bi bi-check-circle me-1"></i> Stok Tersedia
                    </span>
                @elseif($product->stock > 0)
                    <span class="badge bg-warning text-dark">
                        <i class="bi bi-exclamation-triangle me-1"></i> Sisa {{ $product->stock }}
                    </span>
                @else
                    <span class="badge bg-danger">
                        <i class="bi bi-x-circle me-1"></i> Stok Habis
                    </span>
                @endif
            </div>

            {{-- ADD TO CART --}}
            <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="d-flex gap-3 align-items-center">

                    {{-- Quantity --}}
                    <div class="qty-box">
                        <button type="button" onclick="decrementQty()">−</button>
                        <input type="number"
                               id="quantity"
                               name="quantity"
                               value="1"
                               min="1"
                               max="{{ $product->stock }}">
                        <button type="button" onclick="incrementQty()">+</button>
                    </div>

                    {{-- Button --}}
                    <button class="btn btn-primary btn-lg flex-grow-1"
                            @if($product->stock == 0) disabled @endif>
                        <i class="bi bi-cart-plus me-2"></i>
                        Tambah ke Keranjang
                    </button>
                </div>
            </form>

            {{-- Wishlist --}}
            @auth
            <button onclick="toggleWishlist({{ $product->id }})"
                    class="btn btn-outline-danger mb-4 wishlist-btn-{{ $product->id }}">
                <i class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill' : 'bi-heart' }} me-2"></i>
                {{ auth()->user()->hasInWishlist($product) ? 'Hapus dari Wishlist' : 'Tambah ke Wishlist' }}
            </button>
            @endauth

            <hr>

            {{-- Description --}}
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="fw-semibold">Deskripsi Produk</h6>
                        <p class="text-muted">
                            {!! nl2br(e($product->description)) !!}
                        </p>
                        
                        {{-- Meta --}}
                        <div class="row small text-muted">
                            <div class="col-6 mb-2">
                                <i class="bi bi-box me-2"></i> Berat {{ $product->weight }} gram
                            </div>
                            <div class="col-6 mb-2">
                                <i class="bi bi-upc-scan me-2"></i> SKU PROD-{{ $product->id }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

{{-- SCRIPT --}}
@push('scripts')
<script>
    function incrementQty() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.max);
        if (+input.value < max) input.value++;
    }
    function decrementQty() {
        const input = document.getElementById('quantity');
        if (+input.value > 1) input.value--;
    }
</script>
@endpush

<style>
/* ===============================
   PRODUCT DETAIL UI
   =============================== */

.product-image-wrapper {
    position: relative;
    background: #fff;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 20px 50px rgba(0,0,0,.08);
}

.product-main-image {
    width: 100%;
    height: 420px;
    object-fit: contain;
}

.discount-badge {
    position: absolute;
    top: 20px;
    left: 20px;
    background: linear-gradient(135deg,#ef4444,#f97316);
    color: #fff;
    padding: 6px 14px;
    border-radius: 50px;
    font-weight: 600;
    z-index: 2;
}

.product-thumbnails {
    display: flex;
    gap: 10px;
    margin-top: 20px;
    overflow-x: auto;
}

.product-thumbnails img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 12px;
    cursor: pointer;
    border: 2px solid transparent;
    transition: .25s;
}

.product-thumbnails img:hover {
    border-color: var(--primary-color);
    transform: scale(1.05);
}

.product-category {
    font-size: .85rem;
    color: var(--primary-color);
    font-weight: 600;
    text-decoration: none;
}

.product-title {
    font-weight: 700;
    margin: .5rem 0 1rem;
}

.product-price {
    display: flex;
    gap: 12px;
    align-items: center;
}

.price-old {
    text-decoration: line-through;
    color: #94a3b8;
}

.price-final {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
}

/* Quantity */
.qty-box {
    display: flex;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    overflow: hidden;
}

.qty-box button {
    width: 40px;
    background: #f8fafc;
    border: none;
    font-size: 1.2rem;
}

.qty-box input {
    width: 50px;
    border: none;
    text-align: center;
    font-weight: 600;
}
</style>
@endsection
