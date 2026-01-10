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
        <div class="col-lg-6 animate fade-up">

            <span class="badge rounded-pill bg-warning text-dark px-4 py-2 mb-3 shadow-sm animate zoom-in">
                🔥 Promo Spesial Hari Ini
            </span>

            <h1 class="fw-bold display-5 text-white mb-3 lh-sm animate fade-up delay-1">
                Belanja Online <span class="text-warning">Mudah</span><br>
                & <span class="text-info">Terpercaya</span>
            </h1>

            <p class="fs-5 text-light mb-4 animate fade-up delay-2">
                Produk berkualitas, harga terbaik,<br>
                <strong class="text-warning">Gratis Ongkir</strong> untuk pembelian pertama.
            </p>

            <div class="d-flex gap-3 flex-wrap animate fade-up delay-3">
                <a href="{{ route('catalog.index') }}" class="btn btn-primary btn-lg px-4 shadow">
                    <i class="bi bi-bag-check me-2"></i> Mulai Belanja
                </a>
                <a href="{{ route('catalog.index') }}" class="btn btn-outline-light btn-lg px-4">
                    <i class="bi bi-lightning-charge me-2"></i> Lihat Promo
                </a>
            </div>

        </div>
    </div>

</section>


{{-- ================= KATEGORI ================= --}}
<section class="py-5">
    <div class="container">

        <div class="text-center mb-5 animate fade-up">
            <h2 class="fw-bold mb-2">Kategori Populer</h2>
            <p class="text-muted">Jelajahi kategori favorit pelanggan kami</p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-2 animate zoom-in">
                    <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" class="text-decoration-none">
                        <div class="card category-card border-0 text-center h-100">
                            <div class="card-body py-4">
                                <div class="category-icon mb-3">
                                    <img src="{{ $category->image_url }}">
                                </div>
                                <h6 class="fw-semibold mb-1 text-dark">{{ $category->name }}</h6>
                                <small class="text-muted">{{ $category->products_count }} Produk</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ================= PRODUK ================= --}}
<section class="py-5 bg-light">
    <div class="container">

        <div class="text-center mb-4 animate fade-up">
            <h2 class="fw-bold mb-1">Semua Produk</h2>
            <p class="text-muted mb-3">Pilihan produk terbaik untuk kamu</p>
            <a href="{{ route('catalog.index') }}" class="btn btn-primary px-4 w-100">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($allProducts as $product)
                <div class="col-6 col-md-4 col-lg-3 animate fade-up">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ================= PROMO ================= --}}
<section class="promo-section py-5">
    <div class="container">

        <div class="text-center mb-5 animate fade-up">
            <h2 class="fw-bold">Promo Spesial</h2>
            <p class="text-muted">Penawaran terbatas yang sayang dilewatkan</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="promo-card promo-sale float-anim">
                    <span class="promo-badge">🔥 Flash Sale</span>
                    <h3>Diskon Besar Hari Ini</h3>
                    <p>Potongan hingga <strong>50%</strong> untuk produk pilihan.</p>
                    <p class="fw-bold mb-0">🚀 Checkout sekarang!</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="promo-card promo-member float-anim delay-2">
                    <span class="promo-badge">🎁 Member Baru</span>
                    <h3>Bonus Menanti</h3>
                    <p>Voucher <strong>Rp 50.000</strong> untuk pembelian pertama.</p>
                    <a href="{{ route('register') }}" class="btn btn-light mt-2">Daftar Sekarang</a>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

{{-- ================= STYLE ================= --}}
<style>
.hero-img{height:380px;object-fit:cover}
.carousel-fade .carousel-item{transition:opacity .9s}
.category-card{border-radius:18px;box-shadow:0 8px 20px rgba(0,0,0,.05);transition:.3s}
.category-card:hover{transform:translateY(-8px);background:linear-gradient(135deg,#4f46e5,#22c55e)}
.category-card:hover *{color:#fff!important}
.category-icon{width:90px;height:90px;margin:auto;border-radius:50%;background:#f1f3ff;display:flex;align-items:center;justify-content:center}
.category-icon img{width:60px;height:60px;border-radius:50%}
.promo-card{border-radius:22px;padding:2.5rem;color:#fff;min-height:220px;box-shadow:0 15px 40px rgba(0,0,0,.12)}
.promo-sale{background:linear-gradient(135deg,#f59e0b,#ef4444)}
.promo-member{background:linear-gradient(135deg,#2563eb,#7c3aed)}

/* ===== ANIMATION ===== */
.animate{opacity:0;animation:fadeUp .9s forwards}
.fade-up{animation-name:fadeUp}
.zoom-in{animation-name:zoomIn}
.delay-1{animation-delay:.15s}
.delay-2{animation-delay:.3s}
.delay-3{animation-delay:.45s}
.delay-4{animation-delay:.6s}

@keyframes fadeUp{
    from{opacity:0;transform:translateY(30px)}
    to{opacity:1;transform:none}
}
@keyframes zoomIn{
    from{opacity:0;transform:scale(.9)}
    to{opacity:1;transform:scale(1)}
}

/* FLOAT PROMO */
.float-anim{animation:float 4s ease-in-out infinite}
@keyframes float{
    0%{transform:translateY(0)}
    50%{transform:translateY(-10px)}
    100%{transform:translateY(0)}
}
/* ===== HERO BANNER ===== */
.hero-banner {
    height: 520px;
    position: relative;
}

.hero-bg {
    width: 100%;
    height: 520px;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        rgba(0,0,0,.65),
        rgba(0,0,0,.25),
        rgba(0,0,0,.05)
    );
    z-index: 2;
}

.hero-content {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    z-index: 3;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .hero-banner,
    .hero-bg {
        height: 420px;
    }

    .hero-content h1 {
        font-size: 2.2rem;
    }
}


</style>
