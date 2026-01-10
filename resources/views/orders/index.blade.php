{{-- ================================================
     FILE: resources/views/orders/index.blade.php
     FUNGSI: Daftar pesanan user + gambar produk
     ================================================ --}}

@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fw-bold mb-1">Pesanan Saya</h1>
                    <p class="text-muted mb-0">Pantau status dan riwayat belanja Anda</p>
                </div>
                <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                    <i class="bi bi-bag-check fs-3 text-primary"></i>
                </div>
            </div>

            {{-- EMPTY --}}
            @if($orders->isEmpty())
                <div class="card border-0 shadow-lg py-5 text-center rounded-4">
                    <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png"
                         width="120"
                         class="mb-4 opacity-50">
                    <h5 class="fw-bold">Belum Ada Pesanan</h5>
                    <p class="text-muted mb-4">Anda belum melakukan pemesanan.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-4">
                        Mulai Belanja
                    </a>
                </div>
            @else

                @foreach($orders as $order)
                <div class="card border-0 shadow-sm rounded-4 mb-3 overflow-hidden order-card">
                    <div class="card-body p-4">

                        <div class="row align-items-center g-3">

                            {{-- PRODUK IMAGE --}}
                            <div class="col-md-2 col-4">
                                @php
                                    $item = $order->items->first();
                                    $image = $item?->product?->image_url;
                                @endphp

                                <img src="{{ $image ?? asset('assets/no-image.png') }}"
                                     class="rounded-3 border"
                                     style="width:100%; aspect-ratio:1/1; object-fit:cover;">
                            </div>

                            {{-- ORDER INFO --}}
                            <div class="col-md-3 col-8">
                                <div class="fw-bold mb-1">
                                    #{{ $order->order_number }}
                                </div>
                                <small class="text-muted d-block">
                                    <i class="bi bi-calendar3"></i>
                                    {{ $order->created_at->format('d M Y') }}
                                </small>

                                <small class="text-muted d-block mt-1">
                                    {{ $item?->product_name }}
                                    @if($order->items->count() > 1)
                                        <span class="fw-medium">
                                            +{{ $order->items->count() - 1 }} produk
                                        </span>
                                    @endif
                                </small>
                            </div>

                            {{-- TOTAL --}}
                            <div class="col-md-2 col-6">
                                <small class="text-muted">Total</small>
                                <div class="fw-bold">
                                    Rp {{ number_format($order->total_amount,0,',','.') }}
                                </div>
                            </div>

                            {{-- STATUS --}}
                            <div class="col-md-2 col-6">
                                @php
                                    $statusMap = [
                                        'pending' => ['warning','Menunggu'],
                                        'processing' => ['info','Diproses'],
                                        'shipped' => ['primary','Dikirim'],
                                        'delivered' => ['success','Selesai'],
                                        'cancelled' => ['danger','Dibatalkan'],
                                    ];
                                    [$sColor,$sText] = $statusMap[$order->status] ?? ['secondary',$order->status];
                                @endphp
                                <small class="text-muted">Status</small><br>
                                <span class="badge bg-{{ $sColor }} rounded-pill px-3 py-2">
                                    {{ $sText }}
                                </span>
                            </div>

                            {{-- PAYMENT --}}
                            <div class="col-md-2 col-6 mt-3 mt-md-0">
                                @php
                                    $payMap = [
                                        'paid' => ['success','Lunas'],
                                        'pending' => ['warning','Pending'],
                                        'unpaid' => ['danger','Belum Bayar'],
                                    ];
                                    [$pColor,$pText] = $payMap[$order->payment_status] ?? ['secondary',$order->payment_status];
                                @endphp
                                <small class="text-muted">Pembayaran</small><br>
                                <span class="badge bg-{{ $pColor }} rounded-pill px-3 py-2">
                                    {{ $pText }}
                                </span>
                            </div>

                            {{-- ACTION --}}
                            <div class="col-md-1 col-6 text-md-end mt-3 mt-md-0">
                                <a href="{{ route('orders.show',$order) }}"
                                   class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                    Detail
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach

                {{-- PAGINATION --}}
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('home') }}"
                       class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-house-door"></i> Home
                    </a>

                    {{ $orders->links() }}
                </div>

            @endif
        </div>
    </div>
</div>

<style>
.order-card {
    transition: .25s ease;
}
.order-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 15px 40px rgba(0,0,0,.08);
}
</style>
@endsection
