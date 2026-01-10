{{-- ================================================
     FILE: resources/views/orders/show.blade.php
     FUNGSI: Halaman detail pesanan (Enhanced UI)
     ================================================ --}}

@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- Back --}}
            <div class="mb-4">
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Pesanan Saya
                </a>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- HEADER --}}
                <div class="card-header bg-white p-4 border-bottom">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <div>
                            <h2 class="fw-bold mb-1">Order #{{ $order->order_number }}</h2>
                            <small class="text-muted">
                                <i class="bi bi-clock"></i>
                                {{ $order->created_at->format('d M Y • H:i') }}
                            </small>
                        </div>

                        {{-- STATUS --}}
                        @php
                            $statusMap = [
                                'pending' => ['warning','Menunggu Pembayaran'],
                                'processing' => ['info','Diproses'],
                                'shipped' => ['primary','Dikirim'],
                                'delivered' => ['success','Selesai'],
                                'cancelled' => ['danger','Dibatalkan'],
                            ];
                            [$color, $label] = $statusMap[$order->status] ?? ['secondary',$order->status];
                        @endphp

                        <span class="badge bg-{{ $color }} px-4 py-2 rounded-pill fs-6">
                            {{ $label }}
                        </span>
                    </div>
                </div>

                {{-- BODY --}}
                <div class="card-body p-0">

                    {{-- ITEMS --}}
                    <div class="p-4 p-md-5">
                        <h5 class="fw-bold mb-4">Detail Produk</h5>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Produk</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Harga</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                    <tr>
                                        <td class="fw-medium">{{ $item->product_name }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end text-muted">
                                            Rp {{ number_format($item->price,0,',','.') }}
                                        </td>
                                        <td class="text-end fw-semibold">
                                            Rp {{ number_format($item->subtotal,0,',','.') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    @if($order->shipping_cost > 0)
                                    <tr>
                                        <td colspan="3" class="text-end border-0 pt-4">
                                            Ongkos Kirim
                                        </td>
                                        <td class="text-end border-0 pt-4">
                                            Rp {{ number_format($order->shipping_cost,0,',','.') }}
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td colspan="3" class="text-end border-0 fw-bold fs-5">
                                            TOTAL
                                        </td>
                                        <td class="text-end border-0 fw-bold fs-5 text-primary">
                                            Rp {{ number_format($order->total_amount,0,',','.') }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    {{-- SHIPPING --}}
                    <div class="bg-light p-4 p-md-5 border-top">
                        <h5 class="fw-bold mb-3">Alamat Pengiriman</h5>

                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-body">
                                <p class="fw-bold mb-1">{{ $order->shipping_name }}</p>
                                <p class="mb-1 text-muted">
                                    <i class="bi bi-telephone"></i>
                                    {{ $order->shipping_phone }}
                                </p>
                                <p class="mb-0 text-muted">
                                    <i class="bi bi-geo-alt"></i>
                                    {{ $order->shipping_address }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PAYMENT --}}
                @if(isset($snapToken) && $order->status === 'pending')
                <div class="card-footer bg-white text-center py-5">
                    <p class="text-muted mb-4">
                        Silakan selesaikan pembayaran untuk melanjutkan pesanan Anda.
                    </p>
                    <button id="pay-button"
                            class="btn btn-primary btn-lg px-5 py-3 rounded-3 fw-bold shadow">
                        💳 Bayar Sekarang
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- MIDTRANS --}}
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
            onError: () => reset(),
            onClose: () => reset()
        });

        function reset(){
            btn.disabled = false;
            btn.innerHTML = '💳 Bayar Sekarang';
            alert('Pembayaran belum selesai.');
        }
    });
});
</script>
@endpush
@endif
@endsection
