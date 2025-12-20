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
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card bg-warning text-dark border-0" style="min-height: 200px;">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h3>Flash Sale!</h3>
                            <p>Diskon hingga 50% untuk produk pilihan</p>
                            <a href="#" class="btn btn-dark" style="width: fit-content;">
                                Lihat Promo
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-info text-white border-0" style="min-height: 200px;">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h3>Member Baru?</h3>
                            <p>Dapatkan voucher Rp 50.000 untuk pembelian pertama</p>
                            <a href="{{ route('register') }}" class="btn btn-light" style="width: fit-content;">
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

</style>
