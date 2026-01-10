{{-- resources/views/admin/reports/sales.blade.php --}}
@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
<style>
    .summary-card {
        border-radius: 14px;
        transition: .2s ease;
    }
    .summary-card:hover {
        transform: translateY(-3px);
    }
    .filter-card label {
        font-size: .85rem;
        font-weight: 600;
    }
    .progress {
        background-color: #f1f3f5;
    }
    .category-item:not(:last-child) {
        margin-bottom: 1.25rem;
    }
    .table thead th {
        font-size: .8rem;
        text-transform: uppercase;
        letter-spacing: .04em;
    }
    .pagination {
        justify-content: center;
    }
</style>

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Laporan Penjualan</h3>
        <small class="text-muted">Ringkasan performa penjualan berdasarkan periode</small>
    </div>
</div>

{{-- FILTER --}}
<div class="card shadow-sm mb-4 filter-card border-0">
    <div class="card-body">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-6">
                <label class="form-label">Dari Tanggal</label>
                <input type="date" name="date_from" value="{{ $dateFrom }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Sampai Tanggal</label>
                <input type="date" name="date_to" value="{{ $dateTo }}" class="form-control">
            </div>
            <div class="col-md-12 d-flex gap-2 justify-content-between">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-filter-square"></i> Terapkan Filter
                </button>
                <a href="{{ route('admin.reports.export-sales', request()->all()) }}"
                   class="btn btn-success px-4">
                    <i class="bi bi-file-earmark-spreadsheet"></i> Export Data ke Excel
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
                <div class="text-muted small text-uppercase fw-semibold">Total Pendapatan</div>
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
                <div class="text-muted small text-uppercase fw-semibold">Total Transaksi</div>
                <div class="h3 fw-bold mb-0">
                    {{ number_format($summary->total_orders ?? 0) }}
                </div>
                <small class="text-muted">Pesanan dibayar</small>
            </div>
        </div>
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
                    <div class="category-item">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-semibold">{{ $cat->name }}</span>
                            <span class="fw-bold">
                                Rp {{ number_format($cat->total, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="progress" style="height:6px">
                            <div class="progress-bar bg-primary"
                                 style="width: {{ ($cat->total / ($summary->total_revenue ?: 1)) * 100 }}%">
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">
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
                                       class="fw-bold text-decoration-none text-primary">
                                        #{{ $order->order_number }}
                                    </a>
                                </td>
                                <td>
                                    {{ $order->created_at->format('d M Y') }}<br>
                                    <small class="text-muted">{{ $order->created_at->format('H:i') }}</small>
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
                                    <i class="bi bi-graph-down fs-3 d-block mb-2"></i>
                                    Tidak ada data penjualan
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
@endsection
