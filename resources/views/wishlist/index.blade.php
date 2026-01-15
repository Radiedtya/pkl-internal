@extends('layouts.app')

@section('title', 'Wishlist Saya')

@section('content')
<div class="container py-5 wishlist-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="fw-bold mb-1">
                <i class="bi bi-heart-fill text-danger me-2"></i>
                Wishlist Saya
            </h1>
            <p class="text-muted mb-0">
                Simpan produk favorit untuk dibeli nanti
            </p>
        </div>

        @if($products->count())
            <span class="badge wishlist-count bg-danger">
                {{ $products->total() }} Produk
            </span>
        @endif
    </div>

    {{-- CONTENT --}}
    @if($products->count())

        {{-- GRID --}}
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 wishlist-grid">
            @foreach($products as $product)
                <div class="col wishlist-item">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
        </div>

    @else

        {{-- EMPTY --}}
        <div class="wishlist-empty text-center py-5 px-4">
            <div class="icon-wrap mb-3">
                <i class="bi bi-heart"></i>
            </div>
            <h3 class="fw-bold">Wishlist Masih Kosong</h3>
            <p class="text-muted mb-4">
                Kamu belum menyimpan produk favorit.<br>
                Yuk mulai eksplor dan tambahkan ke wishlist 💖
            </p>
            <a href="{{ route('catalog.index') }}"
               class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">
                <i class="bi bi-bag-check me-2"></i>
                Mulai Belanja
            </a>
        </div>

    @endif
</div>

@endsection

<style>
    /* ================= WISHLIST PAGE ================= */
.wishlist-page{
    min-height:60vh;
}

.wishlist-count{
    background:rgba(220,53,69,.1);
    color:#dc3545;
    font-weight:600;
    padding:.55rem 1.1rem;
    border-radius:999px;
}

/* ================= GRID ANIMATION ================= */
.wishlist-item{
    animation:wishlistFade .45s ease both;
}

@keyframes wishlistFade{
    from{
        opacity:0;
        transform:translateY(16px) scale(.98);
    }
    to{
        opacity:1;
        transform:none;
    }
}

/* ================= CARD SOFT OVERRIDE ================= */
.wishlist-page .product-card{
    transition:.25s ease;
}

.wishlist-page .product-card:hover{
    transform:translateY(-5px);
    box-shadow:0 16px 36px rgba(0,0,0,.1);
}

/* MATIIN HOVER TERLALU AGRESIF */
.wishlist-page .product-card:hover img{
    transform:scale(1.05);
}

/* ================= EMPTY STATE ================= */
.wishlist-empty{
    max-width:520px;
    margin:4rem auto;
    background:#fff;
    border-radius:28px;
    box-shadow:0 24px 50px rgba(0,0,0,.08);
}

.wishlist-empty .icon-wrap{
    width:88px;
    height:88px;
    margin:auto;
    background:#fee2e2;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
}

.wishlist-empty i{
    font-size:2.8rem;
    color:#dc3545;
}

/* ================= MOBILE ================= */
@media(max-width:576px){
    .wishlist-empty{
        margin:2rem 1rem;
        padding:2.5rem 1.5rem;
    }
}

</style>