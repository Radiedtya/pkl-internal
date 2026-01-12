@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="container-fluid mt-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">
                <i class="bi bi-people-fill me-2"></i>Data Pengguna
            </h3>
            <p class="text-muted mb-0">Kelola akun admin & customer</p>
        </div>

        {{-- FILTER ROLE --}}
        <form method="GET">
            <select name="role"
                    class="form-select form-select-sm"
                    onchange="this.form.submit()">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>
                <option value="customer" {{ request('role') == 'customer' ? 'selected' : '' }}>
                    Customer
                </option>
            </select>
        </form>
    </div>

    {{-- CARD --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th>Profil</th>
                            <th>Email</th>
                            <th width="15%">Role</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td class="text-muted">{{ $loop->iteration }}</td>

                            {{-- PROFILE --}}
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $user->avatar_url }}"
                                         class="rounded-circle border"
                                         width="42" height="42">

                                    <div>
                                        <div class="fw-semibold">{{ $user->name }}</div>
                                        <small class="text-muted">Telp: {{ $user->phone }}</small>
                                    </div>
                                </div>
                            </td>

                            {{-- EMAIL --}}
                            <td class="text-muted">{{ $user->email }}</td>

                            {{-- ROLE --}}
                            <td>
                                <span class="badge rounded-pill px-3 py-2
                                    {{ $user->role === 'admin'
                                        ? 'bg-primary'
                                        : 'bg-success' }}">
                                    <i class="bi 
                                        {{ $user->role === 'admin'
                                            ? 'bi-shield-lock'
                                            : 'bi-person-badge' }} me-1"></i>
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            {{-- ACTION --}}
                            <td class="text-center">
                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-circle"
                                            title="Hapus User">
                                        <i class="bi bi-eraser"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Tidak ada data pengguna
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection
