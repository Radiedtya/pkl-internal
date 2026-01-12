{{-- ================================================
     FILE: resources/views/home.blade.php
     FUNGSI: Halaman utama website
     ================================================ --}}

@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- ================= HERO SECTION ================= --}}
{{-- ================= HERO BANNER ================= --}}
<section class="hero-banner position-relative overflow-hidden">

    {{-- CAROUSEL --}}
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="{{ asset('assets/banner/hero-3.png') }}" class="hero-bg">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('assets/banner/hero-1.png') }}" class="hero-bg">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('assets/banner/hero-2.png') }}" class="hero-bg">
            </div>

        </div>
    </div>

    {{-- OVERLAY --}}
    <div class="hero-overlay"></div>

    {{-- CONTENT --}}
    <div class="container hero-content">
        <div class="hero-box animate fade-up">

            <span class="badge hero-badge mb-3 animate zoom-in">
                🔥 Promo Spesial Hari Ini
            </span>

            <h1 class="hero-title animate fade-up delay-1">
                Belanja Online <span class="text-warning">Mudah</span><br>
                & <span class="text-info">Terpercaya</span>
            </h1>

            <p class="hero-subtitle animate fade-up delay-2">
                Produk berkualitas, harga terbaik,<br>
                <strong>Gratis Ongkir</strong> untuk pembelian pertama.
            </p>

            <div class="hero-actions animate fade-up delay-3">
                <a href="{{ route('catalog.index') }}" class="btn btn-primary btn-lg px-4">
                    <i class="bi bi-bag-check me-2"></i> Mulai Belanja
                </a>
                <a href="#promo" class="btn btn-outline-light btn-lg px-4">
                    <i class="bi bi-lightning-charge me-2"></i> Promo
                </a>
            </div>

        </div>
    </div>


</section>

{{-- ================= TRUST STATS CARD ================= --}}
<section class="py-5 bg-light">
    <div class="container">

        <div class="row g-4 justify-content-center">

            <div class="col-6 col-md-3">
                <div class="trust-card animate fade-up">
                    <h3>99%</h3>
                    <span>RATING</span>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="trust-card animate fade-up delay-1">
                    <h3>24/7</h3>
                    <span>FAST DELIVERY</span>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="trust-card animate fade-up delay-2">
                    <h3>100%</h3>
                    <span>PEMBAYARAN AMAN</span>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="trust-card animate fade-up delay-3">
                    <h3>Global</h3>
                    <span>BRAND PARTNERS</span>
                </div>
            </div>

        </div>

    </div>
</section>

<hr class="my-0">

{{-- ================= KATEGORI ================= --}}
<section class="py-5">
    <div class="container">

        <div class="text-center mb-5 animate fade-up">
            <h2 class="fw-bold mb-2">Kategori Populer</h2>
            <p class="text-muted">Jelajahi kategori favorit pelanggan kami</p>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($categories as $category)
                <div class="col-6 col-md-4 col-lg-2 animate zoom-in">
                    <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" class="text-decoration-none">
                        <div class="card category-card border-0 text-center h-100">
                            <div class="card-body py-4">
                                <div class="category-icon mb-3">
                                    <img src="{{ $category->image_url }}">
                                </div>
                                <h6 class="fw-semibold mb-1 text-dark">{{ $category->name }}</h6>
                                <small class="text-muted">{{ $category->product_count }} Produk</small>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <p class="text-center text-muted">Kategori tidak tersedia.</p>
            @endforelse
                
        </div>


    </div>
</section>

<hr class="my-0">

{{-- ================= PRODUK ================= --}}
<section class="py-5 bg-light">
    <div class="container">

        <div class="text-center mb-4 animate fade-up">
            <h2 class="fw-bold mb-1">Produk Unggulan</h2>
            <p class="text-muted mb-3">Pilihan produk terbaik untuk kamu</p>
        </div>

        <div class="row g-4">
            @foreach($featuredProducts as $product)
                <div class="col-6 col-md-4 col-lg-3 animate fade-up">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
            <a href="{{ route('catalog.index') }}" class="btn btn-outline-primary px-4 w-100">
                Lihat Semua Produk <i class="bi bi-arrow-right"></i>
            </a>
        </div>

    </div>
</section>

<hr class="my-0">

{{-- ================= PROMO ================= --}}
<section class="promo-section py-5" id="promo">
    <div class="container">

        <div class="text-center mb-5 animate fade-up">
            <h2 class="fw-bold">Promo Spesial</h2>
            <p class="text-muted text-light">Penawaran terbatas yang sayang dilewatkan</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="promo-card promo-sale float-anim">
                    <span class="promo-badge">🔥 Flash Sale</span>
                    <h3>Diskon Besar Hari Ini</h3>
                    <p class="text-light">Potongan hingga <strong>50%</strong> untuk produk pilihan.</p>
                    <p class="fw-bold mb-0 text-light">🚀 Checkout sekarang!</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="promo-card promo-member float-anim delay-2">
                    <span class="promo-badge">🎁 Member Baru</span>
                    <h3>Bonus Menanti</h3>
                    <p class="text-light">Voucher <strong>Rp 50.000</strong> untuk pembelian pertama.</p>
                    <a href="{{ route('register') }}" class="btn btn-light mt-2">Daftar Sekarang</a>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

{{-- ================= STYLE ================= --}}
<style>
    /* ================= GENERAL ================= */
body{
    background:#f8fafc;
}
section{
    position:relative;
}
h1,h2,h3{
    letter-spacing:-.5px;
}

/* ================= HERO ================= */
.hero-banner{
    height:560px;
    border-radius:0 0 40px 40px;
    overflow:hidden;
}
.hero-bg{
    width:100%;
    height:560px;
    object-fit:cover;
    transform:scale(1.05);
}
.hero-overlay{
    position:absolute;
    inset:0;
    background:linear-gradient(
        100deg,
        rgba(0,0,0,.7),
        rgba(0,0,0,.35),
        rgba(0,0,0,.1)
    );
    z-index:2;
}
.hero-content{
    position:absolute;
    inset:0;
    display:flex;
    align-items:center;
    z-index:3;
}
.hero-box{
    max-width:520px;
}
.hero-title{
    color:#fff;
    font-weight:800;
    font-size:3rem;
    line-height:1.15;
}
.hero-subtitle{
    color:#e5e7eb;
    font-size:1.1rem;
}
.hero-badge{
    background:linear-gradient(135deg,#facc15,#f97316);
    color:#111;
    font-weight:600;
    padding:.6rem 1.4rem;
}
.hero-actions{
    display:flex;
    gap:1rem;
    flex-wrap:wrap;
}

/* ================= CATEGORY ================= */
.category-card{
    border-radius:22px;
    background:#fff;
    box-shadow:0 12px 30px rgba(0,0,0,.06);
    transition:.35s ease;
}
.category-card:hover{
    transform:translateY(-10px);
    box-shadow:0 22px 50px rgba(0,0,0,.12);
    background:linear-gradient(135deg,#2563eb,#22c55e);
}
.category-card:hover *{
    color:#fff!important;
}
.category-icon{
    width:88px;
    height:88px;
    background:#f1f5f9;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
}
.category-icon img{
    width:56px;
    height:56px;
    object-fit:cover;
}

/* ================= PRODUCT SECTION ================= */
.bg-light{
    background:#f9fafb!important;
}

/* ================= PROMO ================= */
.promo-card{
    border-radius:26px;
    padding:2.6rem;
    min-height:240px;
    box-shadow:0 20px 50px rgba(0,0,0,.15);
    position:relative;
    overflow:hidden;
}
.promo-card::after{
    content:'';
    position:absolute;
    inset:0;
    background:linear-gradient(180deg,rgba(255,255,255,.15),transparent);
    pointer-events:none;
}
.promo-sale{
    background:linear-gradient(135deg,#f59e0b,#ef4444);
}
.promo-member{
    background:linear-gradient(135deg,#2563eb,#7c3aed);
}
.promo-badge{
    display:inline-block;
    margin-bottom:1rem;
    background:rgba(255,255,255,.25);
    padding:.45rem 1.2rem;
    border-radius:999px;
    font-weight:600;
}

/* ================= ANIMATION ================= */
.animate{opacity:0;animation:fadeUp .9s forwards}
.fade-up{animation-name:fadeUp}
.zoom-in{animation-name:zoomIn}
.delay-1{animation-delay:.15s}
.delay-2{animation-delay:.3s}
.delay-3{animation-delay:.45s}

@keyframes fadeUp{
    from{opacity:0;transform:translateY(30px)}
    to{opacity:1;transform:none}
}
@keyframes zoomIn{
    from{opacity:0;transform:scale(.9)}
    to{opacity:1;transform:scale(1)}
}

/* FLOAT PROMO */
.float-anim{
    animation:float 5s ease-in-out infinite;
}
@keyframes float{
    0%{transform:translateY(0)}
    50%{transform:translateY(-12px)}
    100%{transform:translateY(0)}
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
    .hero-banner,
    .hero-bg{
        height:440px;
    }
    .hero-title{
        font-size:2.2rem;
    }
}

/* ================= TRUST CARD ================= */
.trust-card{
    background:#fff;
    border-radius:22px;
    padding:2.2rem 1.5rem;
    text-align:center;
    box-shadow:0 18px 45px rgba(0,0,0,.08);
    transition:.35s ease;
    position:relative;
    overflow:hidden;
}

.trust-card::after{
    content:'';
    position:absolute;
    inset:0;
    background:linear-gradient(
        120deg,
        rgba(37,99,235,.08),
        rgba(34,197,94,.08)
    );
    opacity:0;
    transition:.35s ease;
}

.trust-card:hover{
    transform:translateY(-10px);
    box-shadow:0 28px 60px rgba(0,0,0,.14);
}

.trust-card:hover::after{
    opacity:1;
}

.trust-card h3{
    font-size:2.6rem;
    font-weight:800;
    margin-bottom:.35rem;
    color:#0f172a;
    letter-spacing:-1px;
}

.trust-card span{
    font-size:.75rem;
    letter-spacing:2px;
    font-weight:600;
    color:#64748b;
}

/* Mobile */
@media(max-width:768px){
    .trust-card h3{
        font-size:2.2rem;
    }
}


</style>