{{-- resources/views/admin/reports/sales.blade.php --}}
@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')

<style>
/* ===== SUMMARY CARD ===== */
.summary-card {
    border-radius: 16px;
    transition: all .25s ease;
    background: linear-gradient(180deg, #ffffff, #f8fafc);
}
.summary-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
}

/* ===== FILTER CARD ===== */
.filter-card {
    border-radius: 16px;
}
.filter-card label {
    font-size: .75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .04em;
    color: #475569;
}

/* ===== BUTTON ===== */
.btn-primary,
.btn-success {
    border-radius: 12px;
    font-weight: 600;
}

/* ===== CATEGORY ===== */
.category-item:not(:last-child) {
    margin-bottom: 1.4rem;
}

.progress {
    height: 6px;
    background-color: #e5e7eb;
    border-radius: 999px;
}
.progress-bar {
    border-radius: 999px;
}

/* ===== TABLE ===== */
.table thead th {
    font-size: .7rem;
    text-transform: uppercase;
    letter-spacing: .08em;
    color: #64748b;
}
.table tbody tr {
    transition: background .15s ease;
}
.table tbody tr:hover {
    background-color: #f8fafc;
}

/* ===== CARD ===== */
.card {
    border-radius: 18px;
}
.card-header {
    border-bottom: 1px solid #e5e7eb;
}

/* ===== PAGINATION ===== */
.pagination {
    justify-content: center;
}
</style>

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Laporan Penjualan</h3>
        <small class="text-muted">
            Analisis pendapatan & transaksi berdasarkan periode
        </small>
    </div>
</div>

{{-- FILTER --}}
<div class="card shadow-sm mb-4 filter-card border-0">
    <div class="card-body">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-6">
                <label class="form-label">Dari Tanggal</label>
                <input type="date" name="date_from"
                       value="{{ $dateFrom }}"
                       class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Sampai Tanggal</label>
                <input type="date" name="date_to"
                       value="{{ $dateTo }}"
                       class="form-control">
            </div>

            <div class="col-md-12 d-flex justify-content-between gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-funnel-fill"></i> Terapkan Filter
                </button>

                <a href="{{ route('admin.reports.export-sales', request()->all()) }}"
                   class="btn btn-success px-4">
                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                </a>
            </div>
        </form>
    </div>
</div>

{{-- SUMMARY --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card summary-card border-0 shadow-sm border-start border-4 border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="text-muted small text-uppercase fw-semibold">
                        Total Pendapatan
                    </div>
                    <i class="bi bi-cash-coin fs-4 text-success"></i>
                </div>
                <div class="h3 fw-bold mb-0">
                    Rp {{ number_format($summary->total_revenue ?? 0, 0, ',', '.') }}
                </div>
                <small class="text-muted">Periode terpilih</small>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card summary-card border-0 shadow-sm border-start border-4 border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="text-muted small text-uppercase fw-semibold">
                        Total Transaksi
                    </div>
                    <i class="bi bi-receipt fs-4 text-primary"></i>
                </div>
                <div class="h3 fw-bold mb-0">
                    {{ number_format($summary->total_orders ?? 0) }}
                </div>
                <small class="text-muted">Pesanan dibayar</small>
            </div>
        </div>
    </div>
</div>

{{-- SALES CHART --}}
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Grafik Penjualan</h5>
        <span class="text-muted small">
            {{ \Carbon\Carbon::parse($dateFrom)->format('d M Y') }}
            –
            {{ \Carbon\Carbon::parse($dateTo)->format('d M Y') }}
        </span>
    </div>

    <div class="card-body">
        <canvas id="salesChart" height="90"></canvas>
    </div>
</div>


<div class="row g-4">
    {{-- CATEGORY PERFORMANCE --}}
    <div class="col-lg-4">
        <div class="card shadow-sm h-100 border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Performa Kategori</h5>
            </div>

            <div class="card-body">
                @forelse($byCategory as $cat)
                    @php
                        $percent = round(($cat->total / ($summary->total_revenue ?: 1)) * 100);
                    @endphp

                    <div class="category-item">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-semibold">{{ $cat->name }}</span>
                            <div class="text-end">
                                <div class="fw-bold">
                                    Rp {{ number_format($cat->total, 0, ',', '.') }}
                                </div>
                                <small class="text-muted">{{ $percent }}%</small>
                            </div>
                        </div>

                        <div class="progress">
                            <div class="progress-bar bg-primary"
                                 style="width: {{ $percent }}%">
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-tags fs-1 d-block mb-2"></i>
                        Tidak ada data kategori
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- TRANSACTION TABLE --}}
    <div class="col-lg-8">
        <div class="card shadow-sm h-100 border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Rincian Transaksi</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Order</th>
                            <th>Tanggal</th>
                            <th>Customer</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                       class="fw-bold text-primary text-decoration-none">
                                        #{{ $order->order_number }}
                                    </a>
                                </td>
                                <td>
                                    {{ $order->created_at->format('d M Y') }}<br>
                                    <small class="text-muted">
                                        {{ $order->created_at->format('H:i') }}
                                    </small>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $order->user->name }}</div>
                                    <small class="text-muted">{{ $order->user->email }}</small>
                                </td>
                                <td class="text-end fw-bold">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-clipboard-data fs-1 d-block mb-3"></i>
                                    <div class="fw-semibold">Belum ada penjualan</div>
                                    <small>Silakan pilih periode lain</small>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white">
                {{ $orders->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('salesChart').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($chartLabels),
        datasets: [{
            label: 'Pendapatan',
            data: @json($chartValues),
            fill: true,
            tension: 0.35,
            borderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 6,
            backgroundColor: 'rgba(59, 130, 246, 0.12)',
            borderColor: '#3b82f6',
            pointBackgroundColor: '#3b82f6'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                    }
                }
            }
        },
        scales: {
            y: {
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                },
                grid: {
                    color: '#e5e7eb'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});
</script>


@endsection
