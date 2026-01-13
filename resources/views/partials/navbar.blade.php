<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top navbar-main">
    <div class="container py-2">

        {{-- LOGO --}}
        <a class="navbar-brand d-flex align-items-center gap-3 me-lg-4" href="/">
            <div class="logo-icon d-flex align-items-center justify-content-center">
                <i class="bi bi-handbag-fill"></i>
            </div>

            <div class="logo-text d-flex flex-column lh-sm">
                <span class="fw-bold fs-5 text-success">SkolaFit</span>
                <small class="text-muted fw-medium">
                    Perlengkapan Olahraga SMK
                </small>
            </div>
        </a>

        {{-- TOGGLER --}}
        <button class="navbar-toggler border-0 ms-auto"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMain">
            <i class="bi bi-list fs-2"></i>
        </button>

        {{-- CONTENT --}}
        <div class="collapse navbar-collapse mt-3 mt-lg-0" id="navbarMain">

            {{-- SEARCH --}}
            <form class="mx-lg-auto my-3 my-lg-0 w-100"
                  style="max-width:380px"
                  action="{{ route('catalog.index') }}"
                  method="GET">

                <div class="search-box d-flex align-items-center">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text"
                           name="q"
                           class="form-control search-input"
                           placeholder="Cari produk..."
                           value="{{ request('q') }}">
                    <button class="btn btn-primary search-btn">
                        Cari
                    </button>
                </div>
            </form>

            {{-- RIGHT MENU --}}
            <ul class="navbar-nav ms-lg-4 align-items-lg-center gap-lg-3 gap-2 mt-3 mt-lg-0">

                {{-- BERANDA --}}
                <li class="nav-item text-center">
                    <a class="nav-link fw-medium nav-underline"
                       href="{{ route('home') }}">
                        <i class="bi bi-house-door-fill me-1"></i>
                        Beranda
                    </a>
                </li>

                {{-- KATALOG --}}
                <li class="nav-item text-center">
                    <a class="nav-link fw-medium nav-underline"
                       href="{{ route('catalog.index') }}">
                        <i class="bi bi-grid-fill me-1"></i>
                        Produk
                    </a>
                </li>

                @auth
                    {{-- WISHLIST --}}
                    <li class="nav-item text-center">
                        <a class="nav-link fw-medium nav-underline"
                           href="{{ route('wishlist.index') }}">
                            <i class="bi bi-heart-fill me-1"></i>
                            Wishlist
                            @if(auth()->user()->wishlists()->count() > 0)
                                <span class="badge-dot bg-danger"></span>
                            @endif
                        </a>
                    </li>

                    {{-- CART --}}
                    <li class="nav-item text-center">
                        <a class="nav-link fw-medium nav-underline"
                           href="{{ route('cart.index') }}">
                            <i class="bi bi-cart-fill me-1"></i>
                            Keranjang
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
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 px-2"
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
                                <a class="dropdown-item rounded-3 text-info"
                                   href="{{ route('orders.index') }}">
                                    <i class="bi bi-clock-history me-2"></i> Riwayat Pesanan
                                </a>
                            </li>

                            @if(auth()->user()->isAdmin())
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item rounded-3 text-primary"
                                       href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-house-check me-2"></i>
                                        Dashboard
                                    </a>
                                </li>
                            @endif

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item rounded-3 text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        Keluar
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
.navbar-main{
    backdrop-filter: blur(6px);
}

/* SEARCH */
.search-box{
    background:#f8f9fa;
    border-radius:999px;
    padding:6px 10px;
    gap:10px;
}
.search-icon{
    color:#6c757d;
    margin-left:10px;
}
.search-input{
    border:none;
    background:transparent;
}
.search-input:focus{
    box-shadow:none;
}
.search-btn{
    border-radius:999px;
    padding:6px 22px;
}

/* BADGE DOT */
.badge-dot{
    position:absolute;
    top:6px;
    right:-2px;
    width:9px;
    height:9px;
    border-radius:50%;
}

/* AVATAR */
.avatar{
    width:34px;
    height:34px;
    object-fit:cover;
}

/* NAV LINK UNDERLINE */
.nav-underline{
    position:relative;
    padding-bottom:4px;
}
.nav-underline::after{
    content:'';
    position:absolute;
    bottom:0;
    left:0;
    width:0;
    height:2px;
    background:#0d6efd;
    transition:.25s ease;
}
.nav-underline:hover::after{
    width:100%;
}

/* LOGO */
.logo-icon{
    width:42px;
    height:42px;
    background:linear-gradient(135deg,#198754,#20c997);
    color:#fff;
    border-radius:12px;
    font-size:1.2rem;
    box-shadow:0 4px 12px rgba(25,135,84,.3);
    transition:.2s ease;
}
.navbar-brand:hover .logo-icon{
    transform:scale(1.06);
}
.logo-text small{
    font-size:.75rem;
    letter-spacing:.3px;
}

/* MOBILE */
@media(max-width:991px){
    .navbar-nav .nav-link{
        padding:.6rem 0;
    }
}

</style>