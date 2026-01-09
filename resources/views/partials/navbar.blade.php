<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">

        {{-- LOGO --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <img src="{{ asset('assets/skolafit-removebg-preview.png') }}"
                 alt="Skolafit"
                 height="60">
        </a>

        {{-- TOGGLER --}}
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- CONTENT --}}
        <div class="collapse navbar-collapse" id="navbarMain">

            {{-- SEARCH --}}
            <form class="mx-lg-auto my-3 my-lg-0"
                  style="max-width: 650px; width:100%;"
                  action="{{ route('catalog.index') }}"
                  method="GET">
                <div class="input-group rounded-pill overflow-hidden border">
                    <input type="text"
                           name="q"
                           class="form-control border-0 px-4"
                           placeholder="Cari produk favorit kamu…"
                           value="{{ request('q') }}">
                    <button class="btn btn-primary px-4" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            {{-- RIGHT MENU --}}
            <ul class="navbar-nav ms-lg-4 align-items-lg-center gap-lg-2">

                {{-- HOME --}}
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                {{-- KATALOG --}}
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="{{ route('catalog.index') }}">
                        Katalog
                    </a>
                </li>

                @auth
                    {{-- WISHLIST --}}
                    <li class="nav-item">
                        <a class="nav-link position-relative icon-btn"
                           href="{{ route('wishlist.index') }}">
                            <i class="bi bi-heart"></i>
                            @if(auth()->user()->wishlists()->count() > 0)
                                <span class="badge-dot bg-danger"></span>
                            @endif
                        </a>
                    </li>

                    {{-- CART --}}
                    <li class="nav-item">
                        <a class="nav-link position-relative icon-btn"
                           href="{{ route('cart.index') }}">
                            <i class="bi bi-cart3"></i>
                            @php
                                $cartCount = auth()->user()->cart?->items()->count() ?? 0;
                            @endphp
                            @if($cartCount > 0)
                                <span class="badge-dot bg-primary"></span>
                            @endif
                        </a>
                    </li>

                    {{-- USER DROPDOWN --}}
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                           href="#"
                           data-bs-toggle="dropdown">
                            <img src="{{ auth()->user()->avatar_url }}"
                                 class="rounded-circle"
                                 width="34"
                                 height="34">
                            <span class="fw-medium d-none d-lg-inline">
                                {{ auth()->user()->name }}
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 mt-2">

                            <li class="px-3 py-2">
                                <div class="fw-semibold">{{ auth()->user()->name }}</div>
                                <div class="text-muted small">{{ auth()->user()->email }}</div>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2"></i> Profil
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i class="bi bi-bag me-2"></i> Pesanan Saya
                                </a>
                            </li>

                            @if(auth()->user()->isAdmin())
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-primary"
                                       href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Admin Panel
                                    </a>
                                </li>
                            @endif

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                @else
                    {{-- GUEST --}}
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="{{ route('login') }}">
                            Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm rounded-pill px-3"
                           href="{{ route('register') }}">
                            Daftar
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
