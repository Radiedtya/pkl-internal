<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached bg-navbar-theme">

    {{-- TOGGLE SIDEBAR (MOBILE) --}}
    <div class="layout-menu-toggle navbar-nav d-xl-none me-3">
        <a class="nav-item nav-link px-0" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    {{-- SEARCH (LEFT & LONG) --}}
    <div class="navbar-nav align-items-center flex-grow-1 me-4">
        <div class="nav-item w-100">
            <div class="input-group input-group-merge w-100">
                <span class="input-group-text bg-transparent border-0">
                    <i class="bx bx-search fs-4"></i>
                </span>
                <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search anything..."
                    aria-label="Search"
                />
            </div>
        </div>
    </div>

    {{-- RIGHT SIDE --}}
    <div class="navbar-nav align-items-center">
        <ul class="navbar-nav flex-row align-items-center">

            {{-- NOTIFICATION --}}
            <li class="nav-item dropdown me-3">
                <a class="nav-link dropdown-toggle hide-arrow position-relative" href="#" data-bs-toggle="dropdown">
                    <i class="bx bx-bell fs-4"></i>
                    <span class="badge bg-danger rounded-pill badge-notifications">3</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-header">Notifications</li>

                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-user me-2"></i>
                            New user registered
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-check-circle me-2"></i>
                            System update completed
                        </a>
                    </li>
                </ul>
            </li>

            {{-- PROFILE --}}
            <li class="nav-item dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="#" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img
                            src="{{ asset('/assets/img/avatars/1.png') }}"
                            class="w-px-40 h-auto rounded-circle"
                            alt="Avatar"
                        >
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('/assets/img/avatars/1.png') }}" class="rounded-circle">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">
                                        {{ Auth::user()->name }}
                                    </span>
                                    <small class="text-muted">
                                        {{ Auth::user()->role ?? 'User' }}
                                    </small>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li><div class="dropdown-divider"></div></li>

                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-user me-2"></i>
                            My Profile
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="/">
                            <i class="menu-icon bx bx-home-circle"></i>
                            Home
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-cog me-2"></i>
                            Settings
                        </a>
                    </li>

                    <li><div class="dropdown-divider"></div></li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item">
                                <i class="bx bx-power-off me-2"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>

        </ul>
    </div>

</nav>
