@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')

{{-- ================== CUSTOM STYLE ================== --}}
<style>
/* ===== SUMMARY FIX ===== */
.summary-wrapper {
    position: sticky;
    top: 110px; /* aman di bawah navbar */
}

.summary-card {
    border-radius: 18px;
    animation: fadeUp .6s ease forwards;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    font-size: .95rem;
    color: #555;
    margin-bottom: 8px;
}

.summary-total {
    display: flex;
    justify-content: space-between;
    font-size: 1.15rem;
    font-weight: 700;
    color: #0d6efd;
}

/* ===== CART ITEM ANIMATION ===== */
.cart-row {
    animation: fadeIn .5s ease forwards;
}

/* ===== ANIMATION ===== */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(25px);
    }
    to {
        opacity: 1;
        transform: none;
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(.98);
    }
    to {
        opacity: 1;
        transform: none;
    }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 991px) {
    .summary-wrapper {
        position: static;
        margin-top: 20px;
    }
}
</style>

<div class="container py-4">

    {{-- Header --}}
    <div class="row align-items-end mb-5">
        <div class="col">
            {{-- Breadcrumb: Supaya user tahu posisi mereka --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-muted text-primary">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Keranjang Belanja</li>
                </ol>
            </nav>
            
            {{-- Title Section --}}
            <div class="d-flex align-items-center">
                <div class="text-dark p-3 rounded-3 me-3 shadow-sm">
                    <i class="bi bi-cart-fill fs-3"></i>
                </div>
                <div>
                    <h2 class="mb-0 fw-bold text-dark">Keranjang Belanja</h2>
                    {{-- <p class="text-muted mb-0">Kamu punya <span class="fw-bold text-primary">3 Produk</span> di dalam keranjang</p> --}}
                </div>
            </div>
        </div>
        
        {{-- Opsional: Tombol aksi cepat --}}
        <div class="col-auto d-none d-md-block">
            <a href="{{ route('catalog.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i>Lanjut Belanja
            </a>
        </div>
    </div>

    <hr class="mb-4 opacity-10">

    @if($cart && $cart->items->count())
    <div class="row g-4">

        {{-- ================= CART ITEMS ================= --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">

                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($cart->items as $item)
                            <tr class="cart-row">
                                {{-- PRODUCT --}}
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $item->product->image_url }}"
                                             class="rounded-3 me-3"
                                             width="60" height="60"
                                             style="object-fit:cover">

                                        <div>
                                            <a href="{{ route('catalog.show', $item->product->slug) }}"
                                               class="fw-semibold text-dark text-decoration-none">
                                                {{ Str::limit($item->product->name, 40) }}
                                            </a>

                                            <div class="small text-muted">
                                                {{ $item->product->category->name }}
                                            </div>

                                            @if($item->product->has_discount)
                                                <span class="badge bg-danger mt-1">
                                                    Diskon {{ $item->product->discount_percentage }}%
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- PRICE --}}
                                <td class="text-center">
                                    @if($item->product->has_discount)
                                        <div class="text-decoration-line-through text-muted small">
                                            {{ $item->product->formatted_original_price }}
                                        </div>
                                    @endif
                                    <div class="fw-semibold text-success">
                                        {{ $item->product->formatted_price }}
                                    </div>
                                </td>

                                {{-- QTY --}}
                                <td class="text-center">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number"
                                               name="quantity"
                                               value="{{ $item->quantity }}"
                                               min="1"
                                               max="{{ $item->product->stock }}"
                                               class="form-control form-control-sm text-center"
                                               style="width:70px"
                                               onchange="this.form.submit()">
                                    </form>
                                </td>

                                {{-- SUBTOTAL --}}
                                <td class="text-end fw-bold text-primary">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>

                                {{-- REMOVE --}}
                                <td>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Hapus item ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        {{-- ================= SUMMARY ================= --}}
        <div class="col-lg-4">
            <div class="summary-wrapper">
                <div class="card summary-card border-0 shadow-lg">
                    <div class="card-body">

                        <h5 class="fw-bold mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-receipt fs-5 text-primary"></i>
                            Ringkasan Belanja
                        </h5>

                        <div class="summary-item">
                            <span>Total Item</span>
                            <span>{{ $cart->items->sum('quantity') }} barang</span>
                        </div>

                        <div class="summary-item mb-3">
                            <span>Total Harga</span>
                            <span>
                                Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}
                            </span>
                        </div>

                        <hr>

                        <div class="summary-total mb-4">
                            <span>Total Bayar</span>
                            <span>
                                Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}
                            </span>
                        </div>

                        <a href="{{ route('checkout.index') }}"
                           class="btn btn-primary btn-lg w-100 mb-2 shadow-sm">
                            <i class="bi bi-credit-card me-2"></i>Checkout
                        </a>

                        <a href="{{ route('catalog.index') }}"
                           class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-left me-2"></i>Lanjut Belanja
                        </a>

                    </div>
                </div>
            </div>
        </div>

    </div>
    @else

    {{-- EMPTY CART --}}
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center py-5 px-4 shadow-sm rounded-4 bg-white">
                <div class="mb-4 d-inline-flex align-items-center justify-content-center rounded-circle bg-light" style="width: 120px; height: 120px;">
                    <i class="bi bi-cart-x text-secondary" style="font-size: 4rem;"></i>
                </div>
                
                <h3 class="fw-bold text-dark">Wah, Keranjangmu Kosong!</h3>
                <p class="text-muted mb-4">
                    Sepertinya kamu belum memilih barang impian. <br>
                    Yuk, cek koleksi terbaru kami sekarang!
                </p>
                
                <a href="{{ route('catalog.index') }}" class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm transition-all">
                    <i class="bi bi-cart me-2"></i>Mulai Belanja
                </a>
            </div>
        </div>
    </div>

<style>
    /* Tambahan agar hover lebih smooth */
    .transition-all {
        transition: all 0.3s ease;
    }
    .transition-all:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>

    @endif
</div>
@endsection
