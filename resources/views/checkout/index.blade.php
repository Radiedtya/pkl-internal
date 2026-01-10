@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container py-5 checkout-page">

    {{-- HEADER --}}
    <div class="mb-4 animate fade-down">
        <h1 class="h3 fw-bold mb-1">Checkout</h1>
        <p class="text-muted mb-0">
            Lengkapi informasi pengiriman dan konfirmasi pesanan Anda
        </p>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="row g-4 align-items-start">

            {{-- ================= FORM ALAMAT ================= --}}
            <div class="col-lg-7 animate fade-right">

                <div class="card checkout-card">
                    <div class="card-body">

                        <div class="section-title mb-3">
                            <i class="bi bi-truck"></i>
                            <span>Informasi Pengiriman</span>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Penerima</label>
                                <input type="text"
                                       name="name"
                                       value="{{ auth()->user()->name }}"
                                       class="form-control"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text"
                                       name="phone"
                                       class="form-control"
                                       placeholder="08xxxxxxxxxx"
                                       required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="address"
                                          rows="4"
                                          class="form-control"
                                          placeholder="Nama jalan, kecamatan, kota, provinsi"
                                          required></textarea>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            {{-- ================= ORDER SUMMARY ================= --}}
            <div class="col-lg-5 animate fade-left">

                {{-- STICKY WRAPPER --}}
                <div class="summary-sticky">

                    <div class="card checkout-card summary-card">
                        <div class="card-body">

                            <div class="section-title mb-3">
                                <i class="bi bi-receipt"></i>
                                <span>Ringkasan Pesanan</span>
                            </div>

                            {{-- ITEM LIST --}}
                            <div class="summary-items">
                                @foreach($cart->items as $item)
                                    <div class="summary-item">

                                        {{-- FOTO --}}
                                        <div class="item-image">
                                            <img src="{{ $item->product->image_url ?? asset('images/placeholder.png') }}"
                                                 alt="{{ $item->product->name }}">
                                        </div>

                                        {{-- INFO --}}
                                        <div class="item-info">
                                            <div class="item-name">
                                                {{ $item->product->name }}
                                            </div>
                                            <div class="item-qty">
                                                Qty {{ $item->quantity }}
                                            </div>
                                        </div>

                                        {{-- HARGA --}}
                                        <div class="item-price">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- TOTAL --}}
                            <div class="summary-total">
                                <div class="d-flex justify-content-between text-muted small mb-2">
                                    <span>Subtotal</span>
                                    <span>
                                        Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between fw-bold fs-5">
                                    <span>Total</span>
                                    <span>
                                        Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            {{-- CTA --}}
                            <button type="submit"
                                    class="btn btn-primary w-100 mt-4 py-2 fw-semibold">
                                <i class="bi bi-lock me-1"></i>
                                Buat Pesanan
                            </button>

                            <p class="text-muted small text-center mt-3 mb-0">
                                Pembayaran aman & terenkripsi
                            </p>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </form>
</div>
@endsection

{{-- ================= STYLE ================= --}}
<style>
.checkout-page{
    --nav-offset: 90px;
}

/* CARD */
.checkout-card{
    border:0;
    border-radius:18px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
    background:#fff;
}

/* SECTION TITLE */
.section-title{
    display:flex;
    align-items:center;
    gap:10px;
    font-weight:700;
}
.section-title i{
    color:#0d6efd;
}

/* STICKY */
.summary-sticky{
    position:sticky;
    top:var(--nav-offset);
}

/* ITEM LIST */
.summary-items{
    max-height:260px;
    overflow-y:auto;
    padding-right:6px;
}
.summary-items::-webkit-scrollbar{
    width:4px;
}
.summary-items::-webkit-scrollbar-thumb{
    background:#ddd;
}

/* ITEM */
.summary-item{
    display:grid;
    grid-template-columns:50px 1fr auto;
    gap:10px;
    padding:10px 0;
    border-bottom:1px dashed #eaeaea;
}
.summary-item:last-child{
    border-bottom:none;
}

.item-image img{
    width:50px;
    height:50px;
    border-radius:10px;
    object-fit:cover;
    background:#f8f9fa;
}

.item-name{
    font-weight:600;
    font-size:.9rem;
}
.item-qty{
    font-size:.8rem;
    color:#6c757d;
}
.item-price{
    font-weight:600;
    white-space:nowrap;
}

/* TOTAL */
.summary-total{
    border-top:1px solid #eee;
    padding-top:1rem;
}

/* ANIMATION */
.animate{
    opacity:0;
    animation:.7s ease forwards;
}
.fade-down{animation-name:fadeDown}
.fade-left{animation-name:fadeLeft}
.fade-right{animation-name:fadeRight}

@keyframes fadeDown{
    from{opacity:0;transform:translateY(-20px)}
    to{opacity:1;transform:none}
}
@keyframes fadeLeft{
    from{opacity:0;transform:translateX(25px)}
    to{opacity:1;transform:none}
}
@keyframes fadeRight{
    from{opacity:0;transform:translateX(-25px)}
    to{opacity:1;transform:none}
}

/* MOBILE */
@media(max-width:991px){
    .summary-sticky{
        position:static;
    }
}
</style>
