@extends('admin.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-xxl container-p-y">

    {{-- ================= WELCOME CARD ================= --}}
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
                                height="160"
                                alt="Dashboard Illustration"
                                class="img-fluid"
                            />
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ================= STAT CARDS ================= --}}
    <div class="row mb-4">

        {{-- USERS --}}
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-md bg-primary rounded">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <span class="text-muted small">Total Pengguna</span>
                            <h4 class="mb-0 fw-bold">{{ \App\Models\User::count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ROLE --}}
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-md bg-warning rounded">
                            <i class="bi bi-person-badge-fill fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <span class="text-muted small">Role Anda</span>
                            <h4 class="mb-0 fw-bold">{{ Auth::user()->role ?? 'User' }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STATUS --}}
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-md bg-success rounded">
                            <i class="bi bi-check-circle-fill fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <span class="text-muted small">Status Akun</span>
                            <h4 class="mb-0 fw-bold text-success">Verified</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ACTIVITY --}}
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-md bg-info rounded">
                            <i class="bi bi-activity fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <span class="text-muted small">Aktivitas</span>
                            <h4 class="mb-0 fw-bold">Normal</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ================= QUICK ACTION ================= --}}
    <div class="row mb-4">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-lightning-charge-fill text-warning me-1"></i>
                        Quick Action
                    </h5>
                </div>

                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-4">
                            <a href="#" class="btn btn-primary w-100">
                                <i class="bi bi-plus-circle me-1"></i>
                                Tambah Data
                            </a>
                        </div>

                        <div class="col-md-4">
                            <a href="#" class="btn btn-outline-secondary w-100">
                                <i class="bi bi-folder2-open me-1"></i>
                                Kelola Data
                            </a>
                        </div>

                        <div class="col-md-4">
                            <a href="#" class="btn btn-outline-danger w-100">
                                <i class="bi bi-gear-fill me-1"></i>
                                Pengaturan Sistem
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ================= FOOTER INFO ================= --}}
    <div class="row">
        <div class="col-lg-12 text-center text-muted small">
            <i class="bi bi-info-circle me-1"></i>
            Dashboard Admin • Sistem berjalan normal • {{ now()->year }}
        </div>
    </div>

</div>
@endsection
