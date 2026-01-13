@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<style>
/* ================= THEME ================= */
:root {
    --bg: #f8fafc;
    --card: #ffffff;
    --text: #0f172a;
    --muted: #64748b;
}

[data-theme="dark"] {
    --bg: #020617;
    --card: #020617;
    --text: #e5e7eb;
    --muted: #94a3b8;
}

body {
    background: var(--bg);
    color: var(--text);
}

/* ================= GLOBAL ================= */
.dashboard-wrapper {
    padding: 24px;
    min-height: 100vh;
}

/* ================= STAT CARD ================= */
.stat-card {
    background: var(--card);
    border-radius: 18px;
    padding: 22px;
    box-shadow: 0 15px 35px rgba(0,0,0,.08);
    transition: .35s;
}
.stat-card:hover {
    transform: translateY(-8px);
}

.stat-title {
    font-size: .7rem;
    letter-spacing: .14em;
    color: var(--muted);
}

.stat-value {
    font-size: 1.8rem;
    font-weight: 800;
}

.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-success { background:#16a34a20; color:#16a34a }
.icon-warning { background:#ca8a0420; color:#ca8a04 }
.icon-danger  { background:#dc262620; color:#dc2626 }
.icon-primary { background:#2563eb20; color:#2563eb }

/* ================= CARD ================= */
.card-clean {
    background: var(--card);
    border-radius: 20px;
    border: 1px solid rgba(148,163,184,.15);
}

.card-header-clean {
    padding: 16px 20px;
    font-weight: 700;
}

/* ================= TOGGLE ================= */
.theme-toggle {
    cursor: pointer;
    font-size: 1.3rem;
}

/* ================= ORDER ================= */
.order-item {
    padding: 14px 20px;
    border-bottom: 1px solid rgba(148,163,184,.15);
}
.order-item:last-child { border-bottom:none }

/* ================= PRODUCT ================= */
.product-card {
    background: var(--card);
    border-radius: 16px;
    padding: 14px;
    text-align: center;
    transition: .3s;
}
.product-card:hover {
    transform: translateY(-6px);
}
.product-card img {
    height: 90px;
    border-radius: 12px;
    object-fit: cover;
}
</style>

<div class="dashboard-wrapper">

    {{-- TOP BAR --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Admin Dashboard</h4>
        <div class="theme-toggle" id="themeToggle">
            <i class="bi bi-moon-stars-fill"></i>
        </div>
    </div>

    {{-- STATS --}}
    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-sm-6">
            <div class="stat-card d-flex justify-content-between">
                <div>
                    <div class="stat-title">TOTAL PENDAPATAN</div>
                    <div class="stat-value counter" data-value="{{ $stats['total_revenue'] }}">0</div>
                </div>
                <div class="stat-icon icon-success">
                    <i class="bi bi-cash-stack"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="stat-card d-flex justify-content-between">
                <div>
                    <div class="stat-title">PESANAN PROSES</div>
                    <div class="stat-value counter" data-value="{{ $stats['pending_orders'] }}">0</div>
                </div>
                <div class="stat-icon icon-warning">
                    <i class="bi bi-clock-history"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="stat-card d-flex justify-content-between">
                <div>
                    <div class="stat-title">STOK MENIPIS</div>
                    <div class="stat-value counter" data-value="{{ $stats['low_stock'] }}">0</div>
                </div>
                <div class="stat-icon icon-danger">
                    <i class="bi bi-exclamation-circle"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="stat-card d-flex justify-content-between">
                <div>
                    <div class="stat-title">TOTAL PRODUK</div>
                    <div class="stat-value counter" data-value="{{ $stats['total_products'] }}">0</div>
                </div>
                <div class="stat-icon icon-primary">
                    <i class="bi bi-box"></i>
                </div>
            </div>
        </div>

    </div>

    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="d-flex align-items-end row">

                    <div class="col-sm-7">
                        <div class="card-body">
                            <h2 class="card-title text-primary mb-2">
                                Selamat Datang, {{ Auth::user()->name ?? 'User' }} 👋
                            </h2>

                            <p class="text-muted fst-italic">
                                Kamu berhasil login ke sistem dashboard admin.
                                Kelola data, pantau aktivitas, dan pastikan semuanya berjalan lancar hari ini 🚀
                            </p>

                            <div class="mt-4">
                                <span class="d-block mb-1">
                                    <i class="bi bi-clock-history me-1 text-primary"></i>
                                    Login terakhir :
                                    <strong>{{ now()->format('d M Y, H:i') }}</strong>
                                </span>
                                <span>
                                    <i class="bi bi-shield-check me-1 text-success"></i>
                                    Status :
                                    <strong class="text-success">Aktif</strong>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-5 text-center text-sm-start">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img
                                src="{{ asset('/assets/img/illustrations/man-with-laptop-light.png') }}"
                                height="100"
                                alt="Dashboard Illustration"
                                class="img-fluid"
                            />
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- CHART --}}
    <div class="card-clean mb-4">
        <div class="card-header-clean d-flex justify-content-between align-items-center">
            <span>Grafik Penjualan</span>
            <select id="rangeFilter" class="form-select w-auto">
                <option value="7">7 Hari</option>
                <option value="30">30 Hari</option>
                <option value="365">1 Tahun</option>
            </select>
        </div>
        <div class="p-3">
            <canvas id="revenueChart" height="120"></canvas>
        </div>
    </div>

    {{-- ORDERS --}}
    <div class="card-clean mb-4">
        <div class="card-header-clean">Pesanan Terbaru</div>
        <div id="orderList">
            @foreach($recentOrders as $order)
            <div class="order-item d-flex justify-content-between">
                <div>
                    <strong>#{{ $order->order_number }}</strong><br>
                    <small>{{ $order->user->name }}</small>
                </div>
                <div class="text-end">
                    Rp {{ number_format($order->total_amount,0,',','.') }}<br>
                    <span class="badge {{ $order->payment_status=='paid'?'bg-success':'bg-warning' }}">
                        {{ strtoupper($order->payment_status) }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary mb-4 pesanan">Lihat Semua &rarr;</a>
        </div>

    </div>

    {{-- PRODUCTS --}}
    <div class="card-clean">
        <div class="card-header-clean">Produk Terlaris</div>
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

{{-- JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
/* DARK MODE */
const toggle = document.getElementById('themeToggle');
const theme = localStorage.getItem('theme');
if(theme) document.documentElement.setAttribute('data-theme', theme);

toggle.onclick = () => {
    const current = document.documentElement.getAttribute('data-theme');
    const next = current === 'dark' ? '' : 'dark';
    document.documentElement.setAttribute('data-theme', next);
    localStorage.setItem('theme', next);
};

/* COUNTER */
document.querySelectorAll('.counter').forEach(el => {
    let target = +el.dataset.value;
    let count = 0;
    let step = target / 50;
    let interval = setInterval(() => {
        count += step;
        if(count >= target){
            el.innerText = target.toLocaleString('id-ID');
            clearInterval(interval);
        } else {
            el.innerText = Math.floor(count).toLocaleString('id-ID');
        }
    }, 20);
});

/* CHART */
let chart = new Chart(document.getElementById('revenueChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode($revenueChart->pluck('date')) !!},
        datasets: [{
            data: {!! json_encode($revenueChart->pluck('total')) !!},
            borderWidth: 3,
            tension: .4,
            fill: true
        }]
    },
    options: { plugins:{ legend:{ display:false } } }
});
</script>

@endsection
