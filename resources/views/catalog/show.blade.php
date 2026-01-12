{{-- ================================================
     FILE: resources/views/catalog/show.blade.php
     FUNGSI: Product Detail Page (Premium Marketplace)
     ================================================ --}}

@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container py-5">

    {{-- BREADCRUMB --}}
    <nav aria-label="breadcrumb" class="mb-4 small">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('catalog.index') }}">Katalog</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('catalog.index',['category'=>$product->category->slug]) }}">
                    {{ $product->category->name }}
                </a>
            </li>
            <li class="breadcrumb-item active">{{ Str::limit($product->name,30) }}</li>
        </ol>
    </nav>

    <div class="row g-5">

        {{-- IMAGE --}}
        <div class="col-lg-6">
            <div class="product-image-wrapper">

                @if($product->has_discount)
                    <span class="discount-badge">
                        -{{ $product->discount_percentage }}%
                    </span>
                @endif

                <img src="{{ $product->image_url }}"
                     id="main-image"
                     class="product-main-image"
                     alt="{{ $product->name }}">

                @if($product->images->count() > 1)
                    <div class="product-thumbnails">
                        @foreach($product->images as $image)
                            <img src="{{ $image->image_path }}"
                                 onclick="document.getElementById('main-image').src=this.src">
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- INFO --}}
        <div class="col-lg-6">

            {{-- CATEGORY --}}
            <small class="product-category bg-primary bg-opacity-10 px-3 py-1 rounded-pill d-inline-block mb-2">
                {{ $product->category->name }}
            </small>

            {{-- TITLE --}}
            <h1 class="product-title">{{ $product->name }}</h1>

            {{-- RATING --}}
            <div class="d-flex align-items-center gap-2 mb-2">
                <div class="rating-stars">
                    ★★★★★
                </div>
                <small class="text-muted">(5 / 5 • 10k+ ulasan)</small>
            </div>

            {{-- PRICE --}}
            <div class="product-price mb-3">
                @if($product->has_discount)
                    <span class="price-old">{{ $product->formatted_original_price }}</span>
                @endif
                <span class="price-final">{{ $product->formatted_price }}</span>
            </div>

            {{-- STOCK --}}
            <div class="mb-3">
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

            {{-- ONGKIR --}}
            <div class="shipping-box mb-4">
                <i class="bi bi-truck me-2"></i>
                Estimasi pengiriman <strong>2–4 hari</strong>
            </div>

            {{-- CTA --}}
            <form method="POST" action="{{ route('cart.add') }}" id="productForm" class="mb-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="d-flex gap-3 align-items-center flex-wrap mb-3">

                    {{-- QTY --}}
                    <div class="qty-box">
                        <button type="button" onclick="decrementQty()">−</button>
                        <input type="number" id="quantity" name="quantity"
                               value="1" min="1" max="{{ $product->stock }}">
                        <button type="button" onclick="incrementQty()">+</button>
                    </div>

                    {{-- BUY NOW --}}
                    <button type="button"
                            onclick="buyNow()"
                            class="btn btn-primary btn-lg flex-grow-1"
                            @if($product->stock==0) disabled @endif>
                         Beli Sekarang
                    </button>

                    {{-- CART --}}
                    <button class="btn btn-outline-primary btn-lg flex-grow-1"
                            @if($product->stock==0) disabled @endif>
                        <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                    </button>

                </div>
            </form>

            {{-- WISHLIST --}}
            @auth
            <button onclick="toggleWishlist({{ $product->id }})"
                    class="btn btn-outline-danger rounded-pill mb-4 wishlist-btn-{{ $product->id }}">
                <i class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill' : 'bi-heart' }} me-1"></i>
                Wishlist
            </button>
            @endauth

            {{-- TRUST BADGE --}}
            <div class="trust-box mb-4">
                <div><i class="bi bi-shield-check"></i> Garansi Produk</div>
                <div><i class="bi bi-lock"></i> Pembayaran Aman</div>
                <div><i class="bi bi-arrow-repeat"></i> Retur 7 Hari</div>
            </div>

            {{-- DESCRIPTION --}}
            <div class="card">
                <div class="card-body">
                    <h6 class="fw-semibold">Deskripsi Produk</h6>
                    <p class="text-muted">{!! nl2br(e($product->description)) !!}</p>

                    <div class="row small text-muted">
                        <div class="col-6">
                            <i class="bi bi-box me-1"></i> {{ $product->weight }} gram
                        </div>
                        <div class="col-6">
                            <i class="bi bi-upc-scan me-1"></i> SKU-{{ $product->id }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

{{-- ================= SCRIPT ================= --}}
@push('scripts')
<script>
function incrementQty(){
    const i=document.getElementById('quantity');
    if(+i.value < +i.max) i.value++;
}
function decrementQty(){
    const i=document.getElementById('quantity');
    if(+i.value > 1) i.value--;
}
function buyNow(){
    const form=document.getElementById('productForm');
    form.action="{{ route('checkout.direct') }}";
    form.submit();
}
</script>
@endpush

{{-- ================= STYLE ================= --}}
<style>
.product-image-wrapper{
    background:#fff;
    border-radius:22px;
    padding:2rem;
    box-shadow:0 25px 60px rgba(0,0,0,.08);
}
.product-main-image{
    width:100%;
    height:420px;
    object-fit:contain;
}
.discount-badge{
    position:absolute;
    top:20px;left:20px;
    background:linear-gradient(135deg,#ef4444,#f97316);
    color:#fff;
    padding:6px 14px;
    border-radius:999px;
    font-weight:700;
}
.product-thumbnails{
    display:flex;
    gap:10px;
    margin-top:20px;
}
.product-thumbnails img{
    width:70px;height:70px;
    border-radius:12px;
    cursor:pointer;
    border:2px solid transparent;
}
.product-thumbnails img:hover{
    border-color:var(--primary-color);
}
.product-category{
    font-size:.85rem;
    font-weight:600;
    color:var(--primary-color);
}
.product-title{
    font-weight:800;
    margin:.4rem 0;
}
.rating-stars{
    color:#facc15;
    font-size:1.1rem;
}
.product-price{
    display:flex;
    gap:12px;
    align-items:center;
}
.price-old{
    text-decoration:line-through;
    color:#94a3b8;
}
.price-final{
    font-size:2rem;
    font-weight:800;
    color:var(--primary-color);
}
.qty-box{
    display:flex;
    border:1px solid #e5e7eb;
    border-radius:14px;
    overflow:hidden;
}
.qty-box button{
    width:42px;
    background:#f8fafc;
    border:none;
    font-size:1.2rem;
}
.qty-box input{
    width:50px;
    border:none;
    text-align:center;
    font-weight:700;
}
.shipping-box{
    background:#f1f5f9;
    padding:.75rem 1rem;
    border-radius:14px;
    font-size:.9rem;
}
.trust-box{
    display:flex;
    gap:20px;
    font-size:.85rem;
    color:#475569;
}
.trust-box i{
    color:var(--primary-color);
    margin-right:6px;
}
.card{
    border:none;
    border-radius:20px;
    box-shadow:0 18px 45px rgba(0,0,0,.08);
}
</style>
