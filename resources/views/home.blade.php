{{-- ================================================
     FILE: resources/views/home.blade.php
     FUNGSI: Halaman utama website
     ================================================ --}}

@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<section class="py-5 overflow-hidden">
    <div class="container py-5">
        <div class="row align-items-center gy-5">

            {{-- TEXT --}}
            <div class="col-lg-6 order-2 order-lg-1">

                <span class="badge rounded-pill bg-warning text-dark mb-4 px-4 py-2 shadow-sm">
                    🔥 Promo Spesial Hari Ini
                </span>

                <h1 class="fw-bold display-5 mb-4 lh-sm">
                    Belanja Online <span class="text-primary">Mudah</span><br>
                    & <span class="text-success">Terpercaya</span>
                </h1>

                <p class="fs-5 text-muted mb-4">
                    Temukan berbagai produk <b>berkualitas</b> dengan harga terbaik.
                    <span class="text-danger fw-semibold">Gratis ongkir</span> untuk pembelian pertama.
                </p>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('catalog.index') }}" class="btn btn-primary btn-lg px-4 shadow-sm">
                        <i class="bi bi-bag-check me-2"></i> Mulai Belanja
                    </a>
                    <a href="{{ route('catalog.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                        <i class="bi bi-lightning-charge me-2"></i> Lihat Promo
                    </a>
                </div>

                {{-- TRUST --}}
                <div class="row mt-5 g-3 text-muted small">
                    <div class="col-auto d-flex align-items-center gap-2">
                        <i class="bi bi-shield-check text-success fs-5"></i>
                        Aman & Terpercaya
                    </div>
                    <div class="col-auto d-flex align-items-center gap-2">
                        <i class="bi bi-truck text-primary fs-5"></i>
                        Pengiriman Cepat
                    </div>
                    <div class="col-auto d-flex align-items-center gap-2">
                        <i class="bi bi-star-fill text-warning fs-5"></i>
                        Rating Tinggi
                    </div>
                </div>

            </div>

            {{-- IMAGE SLIDER --}}
            <div class="col-lg-6 order-1 order-lg-2 d-none d-lg-block">
                <div id="heroCarousel"
                     class="carousel slide carousel-fade"
                     data-bs-ride="carousel"
                     data-bs-interval="3500">

                    <div class="carousel-inner rounded-4 shadow-lg overflow-hidden">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/hero-3.png') }}" class="d-block w-100 hero-img">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/hero-2.png') }}" class="d-block w-100 hero-img">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/hero-1.png') }}" class="d-block w-100 hero-img">
                        </div>
                    </div>

                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

{{-- ================= KATEGORI ================= --}}
<section class="py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2">Kategori Populer</h2>
            <p class="text-muted">Jelajahi kategori favorit pelanggan kami</p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('catalog.index', ['category' => $category->slug]) }}"
                       class="text-decoration-none">

                        <div class="card category-card border-0 text-center h-100">
                            <div class="card-body py-4">
                                <div class="category-icon mb-3">
                                    <img src="{{ $category->image_url }}">
                                </div>
                                <h6 class="fw-semibold mb-1 text-dark">
                                    {{ $category->name }}
                                </h6>
                                <small class="text-muted">
                                    {{ $category->products_count }} Produk
                                </small>
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

        <div class="d-flex justify-content-center align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Semua Produk</h2>

                <p class="text-muted mb-0">Pilihan produk terbaik untuk kamu</p>
                <a href="{{ route('catalog.index') }}" class="btn btn-primary my-3 d-grid">
                    Lihat Semua <i class="bi bi-arrow-bar-down"></i>
                </a>
            </div>

        </div>

        <div class="row g-4">
            @foreach($allProducts as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ================= PROMO ================= --}}
<section id="promo" class="promo-section py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Promo Spesial</h2>
            <p class="text-muted">Penawaran terbatas yang sayang untuk dilewatkan</p>
        </div>

        <div class="row g-4">

            <div class="col-md-6">
                <div class="promo-card promo-sale">
                    <div class="promo-content">
                        <span class="promo-badge">🔥 Flash Sale</span>
                        <h3>Diskon Besar Hari Ini</h3>
                        <p>
                            Nikmati potongan hingga <strong>50%</strong> untuk produk pilihan terbaik.
                            Harga normal tidak akan kembali lagi!
                        </p>
                        <p class="fw-bold mb-0">🚀 Buruan checkout sebelum kehabisan!</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="promo-card promo-member">
                    <div class="promo-content">
                        <span class="promo-badge">🎁 Member Baru</span>
                        <h3>Bonus Spesial Menanti!</h3>
                        <p>
                            Voucher <strong>Rp 50.000</strong> langsung bisa dipakai
                            untuk pembelian pertama kamu.
                        </p>
                        <a href="{{ route('register') }}" class="btn btn-light mt-2">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

{{-- ================= STYLE ================= --}}
<style>
.hero-img {
    height: 380px;
    object-fit: cover;
}

.carousel-fade .carousel-item {
    transition: opacity .9s ease-in-out;
}

.carousel-indicators button {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: rgba(255,255,255,.6);
}

.carousel-indicators .active {
    background-color: #fff;
}

.category-card {
    border-radius: 18px;
    background: #fff;
    box-shadow: 0 8px 20px rgba(0,0,0,.05);
    transition: .3s;
}

.category-card:hover {
    transform: translateY(-8px);
    background: linear-gradient(135deg,#4f46e5,#22c55e);
}

.category-card:hover * {
    color: #fff !important;
}

.category-icon {
    width: 90px;
    height: 90px;
    margin: auto;
    border-radius: 50%;
    background: #f1f3ff;
    display: flex;
    align-items: center;
    justify-content: center;
}

.category-icon img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
}

.promo-card {
    border-radius: 22px;
    padding: 2.5rem;
    color: #fff;
    min-height: 220px;
    box-shadow: 0 15px 40px rgba(0,0,0,.12);
    transition: transform .3s ease, box-shadow .3s ease;
}

.promo-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 45px rgba(0,0,0,.18);
}

.promo-sale {
    background: linear-gradient(135deg,#f59e0b,#ef4444);
}

.promo-member {
    background: linear-gradient(135deg,#2563eb,#7c3aed);
}
</style>
