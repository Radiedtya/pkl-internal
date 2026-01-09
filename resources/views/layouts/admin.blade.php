<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Admin Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
/* ===== GLOBAL ===== */
body {
    font-family: 'Inter', sans-serif;
    background: #f8fafc;
}

/* ===== SIDEBAR ===== */
.sidebar {
    width: 260px;
    min-height: 100vh;
    background: linear-gradient(180deg, #0f172a, #020617);
    display: flex;
    flex-direction: column;
}

/* Brand */
.sidebar-brand {
    padding: 20px;
    color: #fff;
    font-weight: 700;
    font-size: 1.1rem;
    border-bottom: 1px solid rgba(255,255,255,.08);
}

/* Nav */
.sidebar-nav {
    padding: 16px 0;
    flex-grow: 1;
}

.sidebar .nav-link {
    color: #94a3b8;
    padding: 12px 20px;
    margin: 4px 12px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: .25s ease;
    position: relative;
    font-weight: 500;
}

.sidebar .nav-link i {
    font-size: 1.1rem;
}

/* Hover */
.sidebar .nav-link:hover {
    background: rgba(255,255,255,.08);
    color: #fff;
}

/* Active */
.sidebar .nav-link.active {
    background: rgba(255,255,255,.12);
    color: #fff;
}
.sidebar .nav-link.active::before {
    content: '';
    position: absolute;
    left: -12px;
    top: 8px;
    bottom: 8px;
    width: 4px;
    background: #3b82f6;
    border-radius: 0 4px 4px 0;
}

/* Section label */
.sidebar-section {
    padding: 12px 20px;
    font-size: .7rem;
    letter-spacing: .12em;
    color: #64748b;
    margin-top: 16px;
}

/* User */
.sidebar-user {
    padding: 16px 20px;
    border-top: 1px solid rgba(255,255,255,.08);
    color: #e5e7eb;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* ===== TOPBAR ===== */
.topbar {
    background: #fff;
    border-bottom: 1px solid #e5e7eb;
    padding: 14px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

</style>

</head>
<body>

<div class="d-flex">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="sidebar">

        <div class="sidebar-brand">
            <i class="bi bi-shield-lock me-2"></i> Admin Panel
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="{{ route('admin.products.index') }}"
               class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="bi bi-box"></i> Produk
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Kategori
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> Pesanan
            </a>

            <div class="sidebar-section">LAPORAN</div>

            <a href="{{ route('admin.reports.sales') }}"
               class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <i class="bi bi-graph-up-arrow"></i> Penjualan
            </a>
        </nav>

        {{-- User --}}
        <div class="sidebar-user">
            <img src="{{ auth()->user()->avatar_url }}"
                 class="rounded-circle" width="36" height="36">
            <div>
                <div class="fw-semibold">{{ auth()->user()->name }}</div>
                <small class="text-muted">Administrator</small>
            </div>
        </div>

    </aside>

    {{-- ===== MAIN ===== --}}
    <div class="flex-grow-1">

        <header class="topbar">
            <div class="px-4 pt-3">
                @include('partials.flash-messages')
            </div>

            <h5 class="mb-0 fw-semibold">@yield('page-title', 'Dashboard')</h5>
            <div class="d-flex gap-2">
                <a href="/" target="_blank" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-shop"></i>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </header>

        <main class="p-4">
            @yield('content')
        </main>

    </div>
</div>

</body>
</html>
