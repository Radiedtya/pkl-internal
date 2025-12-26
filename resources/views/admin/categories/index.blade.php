{{-- resources/views/admin/categories/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="row">
    <div class="col-lg-12">

        {{-- FLASH MESSAGE --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary fw-bold">Daftar Kategori</h5>
                <button type="button" class="btn btn-sm btn-primary"
                        data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-plus-lg"></i> Tambah Baru
                </button>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Nama Kategori</th>
                                <th class="text-center">Produk</th>
                                <th class="text-center">Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        @if($category->image)
                                            <img src="{{ Storage::url($category->image) }}"
                                                 class="rounded me-2" width="40" height="40">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center me-2"
                                                 style="width:40px;height:40px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-bold">{{ $category->name }}</div>
                                            <small class="text-muted">{{ $category->slug }}</small>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <span class="badge bg-info text-dark">
                                        {{ $category->products_count }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $category->is_active ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </td>

                                <td class="text-end pe-4">
                                    {{-- EDIT --}}
                                    <button type="button"
                                            class="btn btn-sm btn-outline-warning btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-active="{{ $category->is_active }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.categories.destroy', $category) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    Belum ada kategori
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-white">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>

{{-- ================= CREATE MODAL ================= --}}
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content"
              action="{{ route('admin.categories.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox"
                           name="is_active" value="1" checked>
                    <label class="form-check-label">Aktif</label>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- ================= EDIT MODAL (SATU SAJA) ================= --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content"
              method="POST"
              enctype="multipart/form-data"
              id="editForm">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Edit Kategori</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" id="editName"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar (Opsional)</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           id="editActive">
                    <label class="form-check-label">Aktif</label>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    let originalData = {};

    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function () {

            const id     = this.dataset.id;
            const name   = this.dataset.name;
            const active = this.dataset.active === '1';

            const form = document.getElementById('editForm');
            form.action = `/admin/categories/${id}`;

            // set value ke form
            document.getElementById('editName').value = name;
            document.getElementById('editActive').checked = active;

            // SIMPAN DATA AWAL
            originalData = {
                name: name,
                active: active
            };
        });
    });

    // CEGAH SUBMIT JIKA TIDAK ADA PERUBAHAN
    document.getElementById('editForm').addEventListener('submit', function (e) {

        const currentName   = document.getElementById('editName').value.trim();
        const currentActive = document.getElementById('editActive').checked;
        const imageInput    = this.querySelector('input[type="file"]');

        const nameChanged   = currentName !== originalData.name;
        const activeChanged = currentActive !== originalData.active;
        const imageChanged  = imageInput.files.length > 0;

        // notifikasi jika tidak ada perubahan
        if (!nameChanged && !activeChanged && !imageChanged) {
            e.preventDefault();
            alert('Tidak ada perubahan data.');
        }
    });
});
</script>
@endpush
