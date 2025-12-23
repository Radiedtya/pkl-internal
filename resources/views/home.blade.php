{{-- ================================================
     FILE: resources/views/home.blade.php
     FUNGSI: Halaman utama website
     ================================================ --}}

@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    {{-- Hero Section --}}
    <section class="py-5">
        <div class="container py-5">
            <div class="row align-items-center gy-5">

                <!-- TEXT -->
                <div class="col-lg-6">

                    <span class="badge rounded-pill bg-warning text-dark mb-4 px-4 py-2 shadow-sm">
                        🔥 Promo Spesial Hari Ini
                    </span>

                    <h1 class="fw-bold display-5 mb-4 lh-sm">
                        Belanja Online <span class="text-primary">Mudah</span> <br>
                        & <span class="text-success">Terpercaya</span>
                    </h1>

                    <p class="fs-5 text-muted mb-4">
                        Temukan berbagai produk <b>berkualitas</b> dengan harga terbaik.
                        <span class="text-danger fw-semibold">Gratis ongkir</span> untuk pembelian pertama.
                    </p>

                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('catalog.index') }}"
                        class="btn btn-primary btn-lg px-4 shadow-sm">
                            <i class="bi bi-bag-check me-2"></i> Mulai Belanja
                        </a>

                        <a href="#promo"
                        class="btn btn-outline-secondary btn-lg px-4">
                            <i class="bi bi-lightning-charge me-2"></i> Lihat Promo
                        </a>
                    </div>

                    <!-- TRUST INFO -->
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

                <!-- IMAGE -->
                <div class="col-lg-6 d-none d-lg-block text-center">
                    <img src="{{ asset('assets/skolafit.png') }}"
                        alt="Shopping"
                        class="img-fluid shadow-lg floating"
                        style="max-height: 440px;">
                </div>

            </div>
        </div>
    </section>


    {{-- Kategori --}}
    <section class="py-5">
        <div class="container">

            <!-- SECTION TITLE -->
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-2">Kategori Populer</h2>
                <p class="text-muted mb-0">
                    Jelajahi kategori favorit pelanggan kami
                </p>
            </div>

            <!-- CATEGORY LIST -->
            <div class="row g-4 justify-content-center">

                @foreach($categories as $category)
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="{{ route('catalog.index', ['category' => $category->slug]) }}"
                        class="text-decoration-none">

                            <div class="card category-card border-0 text-center h-100">
                                <div class="card-body py-4">

                                    <div class="category-icon mb-3">
                                        <img src="{{ $category->image_url }}"
                                            alt="{{ $category->name }}">
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


    {{-- Produk Unggulan --}}
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Produk Unggulan</h2>
                <a href="{{ route('catalog.index') }}" class="btn btn-outline-primary">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="row g-4">
                @foreach($featuredProducts as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        @include('partials.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Produk Terbaru --}}
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Produk Terbaru</h2>
            <div class="row g-4">
                @foreach($latestProducts as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        @include('partials.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- Promo Banner --}}
    <section class="promo-section py-5">
        <div class="container">
            <div class="row g-4">

                <!-- Flash Sale -->
                <div class="col-md-6">
                    <div class="promo-card promo-sale">
                        <div class="promo-content">
                            <span class="promo-badge">🔥 Flash Sale</span>
                            <h3>Diskon Besar Hari Ini</h3>
                            <p>
                                Nikmati potongan harga hingga
                                <strong>50%</strong> untuk produk pilihan terbaik.
                                Jangan sampai kehabisan!
                            </p>
                            <a href="#" class="btn btn-dark">
                                Lihat Promo
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Member -->
                <div class="col-md-6">
                    <div class="promo-card promo-member">
                        <div class="promo-content">
                            <span class="promo-badge">🎁 Member Baru</span>
                            <h3>Bonus Spesial untuk Kamu</h3>
                            <p>
                                Daftar sekarang dan dapatkan
                                <strong>voucher Rp 50.000</strong>
                                untuk pembelian pertamamu.
                            </p>
                            <a href="{{ route('register') }}" class="btn btn-light">
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>




@endsection

<style>
  .floating {
    animation: float 4s ease-in-out infinite;
  }

  @keyframes float {
    0% { transform: translateY(0); }
    50% { transform: translateY(-12px); }
    100% { transform: translateY(0); }
  }
  .category-card {
    border-radius: 18px;
    background: #ffffff;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    transition: all 0.35s ease;
  }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 35px rgba(0,0,0,0.1);
    }

    .category-icon {
        width: 90px;
        height: 90px;
        margin: 0 auto;
        border-radius: 50%;
        background: #f1f3ff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .category-icon img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 50%;
    }

    .category-card:hover .category-icon {
        background: linear-gradient(135deg, #4f46e5, #22c55e);
    }

    .category-card:hover h6,
    .category-card:hover small {
        color: #ffffff !important;
    }

    .category-card:hover {
        background: linear-gradient(135deg, #4f46e5, #22c55e);
    }
    /* =========================
    PROMO SECTION
    ========================= */
    .promo-section {
        background: transparent;
    }

    /* Card base */
    .promo-card {
        position: relative;
        border-radius: 22px;
        min-height: 220px;
        display: flex;
        align-items: center;
        padding: 2.5rem;
        color: #fff;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        transition: transform .3s ease, box-shadow .3s ease;
    }

    .promo-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 60px rgba(0,0,0,0.18);
    }

    /* Content */
    .promo-content {
        position: relative;
        z-index: 2;
        max-width: 420px;
    }

    .promo-card h3 {
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: .75rem;
    }

    .promo-card p {
        font-size: .95rem;
        opacity: .95;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    /* Badge */
    .promo-badge {
        display: inline-block;
        background: rgba(255,255,255,.25);
        padding: .35rem .8rem;
        border-radius: 50px;
        font-size: .75rem;
        margin-bottom: .75rem;
    }

    /* Variants */
    .promo-sale {
        background: linear-gradient(135deg, #f59e0b, #ef4444);
    }

    .promo-member {
        background: linear-gradient(135deg, #2563eb, #7c3aed);
    }

    /* Button tweak */
    .promo-card .btn {
        border-radius: 50px;
        padding: .55rem 1.4rem;
        font-weight: 500;
    }

</style>
