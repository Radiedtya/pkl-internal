<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top navbar-main">
    <div class="container">

        {{-- LOGO --}}
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold"
           href="{{ route('home') }}">
            <img src="{{ asset('assets/skolafit-removebg-preview.png') }}"
                 alt="Skolafit"
                 height="52">
        </a>

        {{-- TOGGLER --}}
        <button class="navbar-toggler border-0"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMain">
            <i class="bi bi-list fs-2"></i>
        </button>

        {{-- CONTENT --}}
        <div class="collapse navbar-collapse" id="navbarMain">

            {{-- SEARCH --}}
            <form class="mx-lg-auto my-3 my-lg-0 w-100"
                  style="max-width:640px"
                  action="{{ route('catalog.index') }}"
                  method="GET">

                <div class="search-box d-flex align-items-center">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text"
                           name="q"
                           class="form-control search-input"
                           placeholder="Cari produk, kategori, atau brand…"
                           value="{{ request('q') }}">
                    <button class="btn btn-primary search-btn">
                        Cari
                    </button>
                </div>
            </form>

            {{-- RIGHT MENU --}}
            <ul class="navbar-nav ms-lg-4 align-items-lg-center gap-lg-3 mt-3 mt-lg-0">

                {{-- MENU --}}
                <li class="nav-item">
                    <a class="nav-link fw-medium nav-underline"
                       href="{{ route('home') }}">
                       Beranda
                       <i class="bi bi-house text-primary"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-medium nav-underline"
                       href="{{ route('catalog.index') }}">
                        Katalog
                        <i class="bi bi-bag"></i>
                    </a>
                </li>

                @auth
                    {{-- WISHLIST --}}
                    <li class="nav-item">
                        <a class="nav-link icon-btn position-relative"
                           href="{{ route('wishlist.index') }}" title="Wishlist">
                            <i class="bi bi-bag-heart"></i>
                            @if(auth()->user()->wishlists()->count() > 0)
                                <span class="badge-dot bg-danger"></span>
                            @endif
                        </a>
                    </li>

                    {{-- CART --}}
                    <li class="nav-item">
                        <a class="nav-link icon-btn position-relative"
                           href="{{ route('cart.index') }}" title="Keranjang">
                            <i class="bi bi-basket3"></i>
                            @php
                                $cartCount = auth()->user()->cart?->items()->count() ?? 0;
                            @endphp
                            @if($cartCount > 0)
                                <span class="badge-dot bg-primary"></span>
                            @endif
                        </a>
                    </li>

                    {{-- USER --}}
                    <li class="nav-item dropdown ms-lg-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                           href="#"
                           data-bs-toggle="dropdown">
                            <img src="{{ auth()->user()->avatar_url }}"
                                 class="rounded-circle avatar">
                            <span class="fw-semibold d-none d-lg-inline">
                                {{ auth()->user()->name }}
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 mt-3 p-2">

                            <li class="px-3 py-2">
                                <div class="fw-semibold">{{ auth()->user()->name }}</div>
                                <div class="text-muted small">{{ auth()->user()->email }}</div>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item rounded-3"
                                   href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2"></i> Profil
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item rounded-3"
                                   href="{{ route('orders.index') }}">
                                    <i class="bi bi-bag-check me-2"></i> Pesanan Saya
                                </a>
                            </li>

                            @if(auth()->user()->isAdmin())
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item rounded-3 text-primary"
                                       href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>
                                        Dashboard Admin
                                    </a>
                                </li>
                            @endif

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item rounded-3 text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                @else
                    {{-- GUEST --}}
                    <li class="nav-item">
                        <a class="nav-link fw-medium"
                           href="{{ route('login') }}">
                            Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary rounded-pill px-4"
                           href="{{ route('register') }}">
                            Daftar
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
/* NAVBAR */
.navbar-main {
    backdrop-filter: blur(6px);
}

/* SEARCH */
.search-box {
    background: #f8f9fa;
    border-radius: 999px;
    padding: 6px 8px;
    gap: 10px;
}
.search-icon {
    color: #6c757d;
    margin-left: 10px;
}
.search-input {
    border: none;
    background: transparent;
    outline: none;
}
.search-input:focus {
    box-shadow: none;
}
.search-btn {
    border-radius: 999px;
    padding: 6px 20px;
}

/* ICON BUTTON */
.icon-btn {
    font-size: 1.25rem;
    position: relative;
}
.badge-dot {
    position: absolute;
    top: 6px;
    right: 4px;
    width: 9px;
    height: 9px;
    border-radius: 50%;
}

/* AVATAR */
.avatar {
    width: 34px;
    height: 34px;
    object-fit: cover;
}

/* NAV LINK UNDERLINE */
.nav-underline {
    position: relative;
}
.nav-underline::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 0;
    width: 0;
    height: 2px;
    background: #0d6efd;
    transition: .3s;
}
.nav-underline:hover::after {
    width: 100%;
}
</style>
