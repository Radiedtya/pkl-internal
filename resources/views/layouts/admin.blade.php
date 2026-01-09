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
.topbar {
    padding: 1rem 1.5rem;
    background: #fff;
    border-bottom: 1px solid #e5e7eb;
}

.dropdown-menu {
    border-radius: 14px;
}

.dropdown-item:hover {
    background-color: #f1f5f9;
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
        {{-- <div class="sidebar-user">
            <img src="{{ auth()->user()->avatar_url }}"
                 class="rounded-circle" width="36" height="36">
            <div>
                <div class="fw-semibold">{{ auth()->user()->name }}</div>
                <small class="text-muted">Administrator</small>
            </div>
        </div> --}}

    </aside>

    {{-- ===== MAIN ===== --}}
    <div class="flex-grow-1">

        <header class="topbar d-flex justify-content-between align-items-center">
            <div class="px-4 pt-3 w-100">
                @include('partials.flash-messages')
            </div>

            <h5 class="mb-0 fw-semibold me-3">@yield('page-title', 'Dashboard')</h5>

            {{-- RIGHT ACTION --}}
            <div class="dropdown">

                {{-- AVATAR TOGGLE --}}
                <a href="#"
                class="d-flex align-items-center gap-2 text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown"
                aria-expanded="false">

                    <img src="{{ auth()->user()->avatar_url }}"
                        class="rounded-circle border"
                        width="36"
                        height="36"
                        alt="Avatar">

                </a>

                {{-- DROPDOWN MENU --}}
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">

                    {{-- USER INFO --}}
                    <li class="px-3 py-2">
                        <div class="fw-semibold">{{ auth()->user()->name }}</div>
                        <div class="text-muted small">{{ auth()->user()->email }}</div>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    {{-- PROFILE --}}
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2"
                        href="{{ route('profile.edit') }}">
                            <i class="bi bi-person"></i> Profile
                        </a>
                    </li>

                    {{-- LIHAT TOKO --}}
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2"
                        href="/"
                        target="_blank">
                            <i class="bi bi-shop"></i> Lihat Toko
                        </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    {{-- LOGOUT --}}
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="dropdown-item text-danger d-flex align-items-center gap-2">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        </header>


        <main class="p-4">
            @yield('content')
        </main>

    </div>
</div>

</body>
</html>
