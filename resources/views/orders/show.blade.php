{{-- ================================================
 FILE: resources/views/orders/show.blade.php
 FUNGSI: Detail Pesanan (Premium UI)
================================================ --}}

@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container py-5 order-detail">

    <div class="row justify-content-center">
        <div class="col-lg-11">

            {{-- BACK --}}
            <div class="mb-4 animate fade-left">
                <a href="{{ route('orders.index') }}"
                   class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="bi bi-arrow-left"></i> Pesanan Saya
                </a>
            </div>

            <div class="card border-0 shadow-xl rounded-4 overflow-hidden animate fade-up">

                {{-- HEADER --}}
                <div class="card-header bg-white p-4 border-bottom">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-3">

                        <div>
                            <h3 class="fw-bold mb-1">
                                <i class="bi bi-box-seam text-primary"></i>
                                Order #{{ $order->order_number }}
                            </h3>
                            <small class="text-muted">
                                <i class="bi bi-clock-history"></i>
                                {{ $order->created_at->format('d M Y • H:i') }}
                            </small>
                        </div>

                        {{-- STATUS --}}
                        @php
                            $statusMap = [
                                'pending' => ['warning','Menunggu Pembayaran',''],
                                'processing' => ['primary','Diproses',''],
                                'shipped' => ['primary','Dikirim','truck'],
                                'delivered' => ['success','Selesai',''],
                                'cancelled' => ['danger','Dibatalkan',''],
                            ];
                            // tambahkan ikon sesuai kebutuhan
                            [$color,$label,$icon] = $statusMap[$order->status] ?? ['secondary',$order->status,'question-circle'];
                        @endphp

                        <span class="badge bg-{{ $color }} px-4 py-3 rounded-pill fs-5">{{ $label }}</span>

                    </div>
                </div>

                {{-- BODY --}}
                <div class="card-body p-0">

                    {{-- ================= ITEMS ================= --}}
                    <div class="p-4 p-md-5">
                        <h5 class="fw-bold mb-4">
                            <i class="bi bi-bag-check"></i> Produk Dipesan
                        </h5>

                        <div class="order-items">

                            @foreach($order->items as $item)
                            <div class="order-item">

                                {{-- IMAGE --}}
                                <img src="{{ $item->product->image_url ?? asset('images/placeholder.png') }}"
                                     alt="{{ $item->product_name }}">

                                {{-- INFO --}}
                                <div class="item-info">
                                    <div class="fw-semibold">
                                        {{ $item->product_name }}
                                    </div>
                                    <small class="text-muted">
                                        Qty {{ $item->quantity }}
                                    </small>
                                </div>

                                {{-- PRICE --}}
                                <div class="item-price">
                                    <div class="text-muted small">
                                        Rp {{ number_format($item->price,0,',','.') }}
                                    </div>
                                    <div class="fw-bold">
                                        Rp {{ number_format($item->subtotal,0,',','.') }}
                                    </div>
                                </div>

                            </div>
                            @endforeach

                        </div>

                        {{-- TOTAL --}}
                        <div class="order-total mt-4">
                            @if($order->shipping_cost > 0)
                            <div class="d-flex justify-content-between mb-2 text-muted">
                                <span>
                                    <i class="bi bi-truck"></i> Ongkos Kirim
                                </span>
                                <span>
                                    Rp {{ number_format($order->shipping_cost,0,',','.') }}
                                </span>
                            </div>
                            @endif

                            <div class="d-flex justify-content-between fw-bold fs-4">
                                <span>Total</span>
                                <span class="text-primary">
                                    Rp {{ number_format($order->total_amount,0,',','.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- ================= SHIPPING ================= --}}
                    <div class="bg-light p-4 p-md-5 border-top">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-geo-alt"></i> Alamat Pengiriman
                        </h5>

                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body">
                                <p class="fw-bold mb-1">
                                    {{ $order->shipping_name }}
                                </p>
                                <p class="mb-1 text-muted">
                                    <i class="bi bi-telephone"></i>
                                    {{ $order->shipping_phone }}
                                </p>
                                <p class="mb-0 text-muted">
                                    <i class="bi bi-house-door"></i>
                                    {{ $order->shipping_address }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ================= PAYMENT ================= --}}
                @if(isset($snapToken) && $order->status === 'pending')
                <div class="card-footer bg-white text-center py-5">
                    <p class="text-muted mb-4">
                        Selesaikan pembayaran untuk memproses pesanan Anda.
                    </p>
                    <button id="pay-button"
                            class="btn btn-primary btn-lg px-5 py-3 rounded-pill fw-bold shadow">
                        Bayar Sekarang
                    </button>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

{{-- ================= STYLE ================= --}}
<style>
.order-detail{
    --radius:18px;
}

/* CARD */
.shadow-xl{
    box-shadow:0 20px 50px rgba(0,0,0,.12);
}

/* ITEMS */
.order-items{
    display:flex;
    flex-direction:column;
    gap:16px;
}
.order-item{
    display:grid;
    grid-template-columns:70px 1fr auto;
    gap:14px;
    align-items:center;
    padding:14px;
    border-radius:var(--radius);
    background:#fff;
    box-shadow:0 8px 20px rgba(0,0,0,.05);
    transition:.25s;
}
.order-item:hover{
    transform:translateY(-2px);
}

/* IMAGE */
.order-item img{
    width:70px;
    height:70px;
    border-radius:14px;
    object-fit:cover;
}

/* PRICE */
.item-price{
    text-align:right;
    white-space:nowrap;
}

/* TOTAL */
.order-total{
    border-top:1px dashed #ddd;
    padding-top:1.2rem;
}

/* ANIMATION */
.animate{
    opacity:0;
    animation:.7s ease forwards;
}
.fade-up{animation-name:fadeUp}
.fade-left{animation-name:fadeLeft}

@keyframes fadeUp{
    from{opacity:0;transform:translateY(30px)}
    to{opacity:1;transform:none}
}
@keyframes fadeLeft{
    from{opacity:0;transform:translateX(-30px)}
    to{opacity:1;transform:none}
}
</style>

{{-- ================= MIDTRANS ================= --}}
@if(isset($snapToken))
@push('scripts')
<script src="{{ config('midtrans.snap_url') }}"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('pay-button');
    if (!btn) return;

    btn.addEventListener('click', () => {
        btn.disabled = true;
        btn.innerHTML = `
            <span class="spinner-border spinner-border-sm"></span>
            Memproses...
        `;

        snap.pay('{{ $snapToken }}', {
            onSuccess: () => location.href = '{{ route("orders.success",$order) }}',
            onPending: () => location.href = '{{ route("orders.pending",$order) }}',
            onError: reset,
            onClose: reset
        });

        function reset(){
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-credit-card-2-back"></i> Bayar Sekarang';
            alert('Pembayaran belum selesai.');
        }
    });
});
</script>
@endpush
@endif
@endsection
