@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<style>
/* ===== GLOBAL ===== */
.dashboard-wrapper {
    background: #f8fafc;
    padding: 24px;
}

/* ===== STAT CARDS ===== */
.stat-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,.04);
    transition: .3s ease;
    height: 100%;
    border: 1px solid #eef2f7;
}
.stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,.08);
}

.stat-title {
    font-size: .75rem;
    letter-spacing: .08em;
    color: #64748b;
    margin-bottom: 6px;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0f172a;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

/* icon colors */
.icon-success { background: #dcfce7; color: #16a34a; }
.icon-warning { background: #fef9c3; color: #ca8a04; }
.icon-danger  { background: #fee2e2; color: #dc2626; }
.icon-primary { background: #dbeafe; color: #2563eb; }

/* ===== CARD ===== */
.card-clean {
    background: #fff;
    border-radius: 18px;
    border: 1px solid #eef2f7;
    box-shadow: 0 10px 25px rgba(0,0,0,.04);
}

.card-header-clean {
    padding: 16px 20px;
    border-bottom: 1px solid #eef2f7;
    font-weight: 600;
}

/* ===== ORDERS ===== */
.order-item {
    padding: 14px 20px;
    border-bottom: 1px solid #f1f5f9;
}
.order-item:last-child {
    border-bottom: none;
}

/* ===== PRODUCT ===== */
.product-card {
    background: #fff;
    border-radius: 14px;
    padding: 12px;
    border: 1px solid #eef2f7;
    transition: .3s;
    text-align: center;
}
.product-card:hover {
    box-shadow: 0 12px 30px rgba(0,0,0,.08);
    transform: translateY(-4px);
}
.product-card img {
    height: 90px;
    object-fit: cover;
    border-radius: 10px;
}
</style>

<div class="dashboard-wrapper">

    {{-- ===== STATS ===== --}}
    <div class="row g-4 mb-4">

        <div class="col-sm-6 col-xl-3">
            <div class="stat-card d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-title">TOTAL PENDAPATAN</div>
                    <div class="stat-value">
                        Rp {{ number_format($stats['total_revenue'],0,',','.') }}
                    </div>
                </div>
                <div class="stat-icon icon-success">
                    <i class="bi bi-currency-dollar"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="stat-card d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-title">PESANAN DIPROSES</div>
                    <div class="stat-value">{{ $stats['pending_orders'] }}</div>
                </div>
                <div class="stat-icon icon-warning">
                    <i class="bi bi-clock-history"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="stat-card d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-title">STOK MENIPIS</div>
                    <div class="stat-value">{{ $stats['low_stock'] }}</div>
                </div>
                <div class="stat-icon icon-danger">
                    <i class="bi bi-exclamation-circle"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="stat-card d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-title">TOTAL PRODUK</div>
                    <div class="stat-value">{{ $stats['total_products'] }}</div>
                </div>
                <div class="stat-icon icon-primary">
                    <i class="bi bi-box"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- ===== CHART + ORDERS ===== --}}
    <div class="row g-4">

        <div class="col-lg-8">
            <div class="card-clean h-100">
                <div class="card-header-clean">
                    Grafik Penjualan 7 Hari Terakhir
                </div>
                <div class="p-3">
                    <canvas id="revenueChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-clean h-100">
                <div class="card-header-clean">
                    Pesanan Terbaru
                </div>

                @foreach($recentOrders as $order)
                <div class="order-item d-flex justify-content-between">
                    <div>
                        <div class="fw-semibold">#{{ $order->order_number }}</div>
                        <small class="text-muted">{{ $order->user->name }}</small>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold">
                            Rp {{ number_format($order->total_amount,0,',','.') }}
                        </div>
                        <span class="badge {{ $order->payment_status=='paid'?'bg-success':'bg-secondary' }}">
                            {{ strtoupper($order->payment_status) }}
                        </span>
                    </div>
                </div>
                @endforeach

                <div class="text-center py-3">
                    <a href="{{ route('admin.orders.index') }}" class="fw-semibold text-decoration-none">
                        Lihat Semua →
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- ===== TOP PRODUCTS ===== --}}
    <div class="card-clean mt-4">
        <div class="card-header-clean">
            Produk Terlaris
        </div>
        <div class="p-3">
            <div class="row g-3">
                @foreach($topProducts as $product)
                <div class="col-6 col-md-2">
                    <div class="product-card">
                        <img src="{{ $product->image_url }}" class="w-100 mb-2">
                        <div class="fw-semibold text-truncate">{{ $product->name }}</div>
                        <small class="text-muted">{{ $product->sold }} terjual</small>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

{{-- CHART --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('revenueChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode($revenueChart->pluck('date')) !!},
        datasets: [{
            data: {!! json_encode($revenueChart->pluck('total')) !!},
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37,99,235,.1)',
            borderWidth: 3,
            tension: .4,
            fill: true,
            pointRadius: 4
        }]
    },
    options: {
        plugins: { legend: { display: false }},
        scales: {
            y: {
                ticks: {
                    callback: v => 'Rp ' + new Intl.NumberFormat('id-ID').format(v)
                }
            }
        }
    }
});
</script>

@endsection
