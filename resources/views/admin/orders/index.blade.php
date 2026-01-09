@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')
<style>
    .order-number {
        font-weight: 600;
        color: var(--bs-primary);
    }
    .status-badge {
        padding: .35rem .7rem;
        font-size: .75rem;
        border-radius: 50rem;
    }
    .filter-nav .nav-link {
        font-size: .85rem;
        padding: .4rem .9rem;
    }
    .filter-nav .nav-link.active {
        font-weight: 600;
    }
    .pagination {
        justify-content: center;
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-12">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Daftar Pesanan</h3>
                <small class="text-muted">Kelola dan pantau pesanan pelanggan</small>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            {{-- FILTER --}}
            <div class="card-header bg-white py-3 px-4">
                <ul class="nav nav-pills filter-nav gap-2">
                    <li class="nav-item">
                        <a class="nav-link {{ !request('status') ? 'active' : '' }}"
                           href="{{ route('admin.orders.index') }}">
                            Semua
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}"
                           href="{{ route('admin.orders.index', ['status' => 'pending']) }}">
                            Pending
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('status') == 'processing' ? 'active' : '' }}"
                           href="{{ route('admin.orders.index', ['status' => 'processing']) }}">
                            Diproses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('status') == 'completed' ? 'active' : '' }}"
                           href="{{ route('admin.orders.index', ['status' => 'completed']) }}">
                            Selesai
                        </a>
                    </li>
                </ul>
            </div>

            {{-- TABLE --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Order</th>
                                <th>Customer</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td class="ps-4">
                                        <div class="order-number">#{{ $order->order_number }}</div>
                                    </td>

                                    <td>
                                        <div class="fw-semibold">{{ $order->user->name }}</div>
                                        <small class="text-muted">{{ $order->user->email }}</small>
                                    </td>

                                    <td>
                                        <div>{{ $order->created_at->format('d M Y') }}</div>
                                        <small class="text-muted">{{ $order->created_at->format('H:i') }}</small>
                                    </td>

                                    <td class="fw-semibold">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        @if($order->status == 'pending')
                                            <span class="status-badge bg-warning-subtle text-warning">Pending</span>
                                        @elseif($order->status == 'processing')
                                            <span class="status-badge bg-info-subtle text-info">Diproses</span>
                                        @elseif($order->status == 'completed')
                                            <span class="status-badge bg-success-subtle text-success">Selesai</span>
                                        @elseif($order->status == 'cancelled')
                                            <span class="status-badge bg-danger-subtle text-danger">Batal</span>
                                        @endif
                                    </td>

                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin.orders.show', $order) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-receipt fs-3 d-block mb-2"></i>
                                        Tidak ada pesanan ditemukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- PAGINATION --}}
            <div class="card-footer bg-white py-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
