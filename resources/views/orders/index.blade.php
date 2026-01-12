@extends('layouts.app')

@section('title','Pesanan Saya')

@section('content')
<div class="container py-5">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1">Pesanan Saya</h1>
            <p class="text-muted mb-0">Pantau status & riwayat belanja kamu</p>
        </div>
        <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
            <i class="bi bi-bag-check fs-3 text-primary"></i>
        </div>
    </div>

    {{-- FILTER --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">

                {{-- STATUS FILTER --}}
                <div class="col-lg-7">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-filter-circle me-1"></i>
                        Filter Status
                    </label>

                    @php
                        $statuses = [
                            null => ['SEMUA','secondary','bi-grid'],
                            'pending' => ['UNPAID','warning','bi-hourglass-split'],
                            'processing' => ['PROCESSING','info','bi-gear'],
                            'completed' => ['COMPLETED','secondary','bi-check-circle'],
                        ];
                    @endphp

                    <div class="d-flex flex-wrap gap-2">
                        @foreach($statuses as $key => [$label,$color,$icon])
                            @php
                                $active = request('status')===$key || (!$key && !request('status'));
                            @endphp
                            <a href="{{ route('orders.index', array_filter(['status'=>$key,'q'=>request('q')])) }}"
                               class="btn btn-{{ $active ? $color : 'outline-'.$color }} rounded-pill px-4">
                                <i class="bi {{ $icon }} me-1"></i>
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- SEARCH --}}
                <div class="col-lg-5">
                    <label class="form-label fw-semibold">Cari Pesanan</label>

                    <form method="GET" class="d-flex gap-2">
                        @if(request('status'))
                            <input type="hidden" name="status" value="{{ request('status') }}">
                        @endif

                        <input type="text"
                               name="q"
                               value="{{ request('q') }}"
                               class="form-control rounded-pill"
                               placeholder="Nama barang...">

                        <button class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-search"></i>
                            Cari
                        </button>

                        @if(request('status') || request('q'))
                            <a href="{{ route('orders.index') }}"
                               class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="bi bi-arrow-counterclockwise"></i>
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- ORDER LIST --}}
    @forelse($orders as $order)
    <div class="card border-0 shadow-sm rounded-4 mb-3 order-card animate-card">
        <div class="card-body p-4">
            <div class="row align-items-center g-3">

                {{-- IMAGE --}}
                <div class="col-md-2 col-4">
                    @php $item = $order->items->first(); @endphp
                    <img src="{{ $item?->product?->image_url ?? asset('assets/no-image.png') }}"
                         class="rounded-3 w-100"
                         style="aspect-ratio:1/1;object-fit:cover;">
                </div>

                {{-- INFO --}}
                <div class="col-md-3 col-8">
                    <div class="fw-bold">
                        
                        {{ $item?->product?->name }}
                    </div>
                    <small class="text-muted d-block">
                        <i class="bi bi-calendar-event me-1"></i>
                        {{ $order->created_at->format('d M Y') }}
                    </small>
                    @if($order->items->count() > 1)
                        <small class="text-muted">
                            +{{ $order->items->count()-1 }} produk lainnya
                        </small>
                    @endif
                </div>

                {{-- TOTAL --}}
                <div class="col-md-2 col-6">
                    <small class="text-muted">Total</small>
                    <div class="fw-bold">
                        Rp {{ number_format($order->total_amount,0,',','.') }}
                    </div>
                </div>

                {{-- ORDER STATUS --}}
                <div class="col-md-2 col-6">
                    <small class="text-muted">Status Pesanan</small><br>
                    <span class="badge rounded-pill px-3 py-2
                        bg-{{ 
                            $order->status=='pending'?'warning':
                            ($order->status=='processing'?'info':'secondary')
                        }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                {{-- PAYMENT STATUS --}}
                <div class="col-md-2 col-6">
                    <small class="text-muted">Status Pembayaran</small>
                    @php
                        $payment = $order->payment_status;
                        $payColor = $payment=='paid'?'success':($payment=='failed'?'danger':'warning');
                        $payIcon = $payment=='paid'?'bi-check-circle':($payment=='failed'?'bi-x-circle':'bi-credit-card');
                    @endphp

                    <span class="badge rounded-pill px-3 py-2 payment-badge bg-{{ $payColor }}">
                        <i class="bi {{ $payIcon }} me-1"></i>
                        {{ strtoupper($payment) }}
                    </span>
                </div>

                {{-- ACTION --}}
                <div class="col-md-1 text-md-end">
                    <a href="{{ route('orders.show',$order) }}"
                       class="btn btn-outline-primary btn-sm rounded-pill px-4">
                       <i class="bi bi-eye"></i>
                       Lihat
                    </a>
                </div>

            </div>
        </div>
    </div>
    @empty
        <div class="text-center py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076508.png"
                 width="120" class="mb-3 opacity-75">
            <h5 class="fw-bold">Pesanan tidak ditemukan</h5>
            <p class="text-muted">Coba reset filter atau cari produk lain</p>
        </div>
    @endforelse

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links() }}
    </div>

</div>

<style>
/* CARD HOVER */
.order-card{
    transition:.35s ease;
}
.order-card:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 45px rgba(0,0,0,.1);
}

/* FADE SLIDE ANIMATION */
.animate-card{
    animation:fadeUp .6s ease forwards;
}
@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(20px);
    }
    to{
        opacity:1;
        transform:none;
    }
}

/* PAYMENT BADGE PULSE (UNPAID) */
.payment-badge.bg-warning{
    animation:pulse 1.6s infinite;
}
@keyframes pulse{
    0%{ box-shadow:0 0 0 0 rgba(255,193,7,.6); }
    70%{ box-shadow:0 0 0 10px rgba(255,193,7,0); }
    100%{ box-shadow:0 0 0 0 rgba(255,193,7,0); }
}
</style>
@endsection
