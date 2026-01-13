{{-- resources/views/profile/partials/update-profile-information-form.blade.php --}}

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        {{-- HEADER --}}
        <div class="mb-4">
            <h5 class="fw-bold mb-1">
                <i class="bi bi-person-lines-fill me-2"></i>Informasi Profil
            </h5>
            <p class="text-muted small mb-0">
                Perbarui data akun dan alamat email kamu.
            </p>
        </div>

        {{-- FORM VERIFIKASI EMAIL --}}
        <form id="send-verification" method="post" action="">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="row g-3">

                {{-- Nama --}}
                <div class="col-md-6">
                    <label for="name" class="form-label small fw-semibold">
                        Nama Lengkap
                    </label>
                    <input type="text"
                           name="name"
                           id="name"
                           class="form-control form-control-lg @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name) }}"
                           required autofocus autocomplete="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <label for="email" class="form-label small fw-semibold">
                        Email
                    </label>
                    <input type="email"
                           name="email"
                           id="email"
                           class="form-control form-control-lg @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}"
                           required autocomplete="username">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email Verification --}}
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="col-12">
                        <div class="alert alert-warning d-flex align-items-center gap-2 py-2 small mb-0">
                            <i class="bi bi-exclamation-circle"></i>
                            <div class="flex-grow-1">
                                Email kamu belum diverifikasi.
                                <button form="send-verification"
                                        class="btn btn-link p-0 fw-semibold text-decoration-none">
                                    Kirim ulang verifikasi
                                </button>
                            </div>
                        </div>

                        @if (session('status') === 'verification-link-sent')
                            <div class="text-success small mt-2 fw-semibold">
                                <i class="bi bi-check-circle me-1"></i>
                                Link verifikasi baru telah dikirim.
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Phone --}}
                <div class="col-md-6">
                    <label for="phone" class="form-label small fw-semibold">
                        Nomor Telepon
                    </label>
                    <input type="tel"
                           name="phone"
                           id="phone"
                           class="form-control form-control-lg @error('phone') is-invalid @enderror"
                           value="{{ old('phone', $user->phone) }}"
                           placeholder="08xxxxxxxxxx">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text small">
                        Contoh: 08xxxxxxxxxx atau +628xxxxxxxxxx
                    </div>
                </div>

                {{-- Address --}}
                <div class="col-md-6">
                    <label for="address" class="form-label small fw-semibold">
                        Alamat Lengkap
                    </label>
                    <textarea name="address"
                              id="address"
                              rows="4"
                              class="form-control @error('address') is-invalid @enderror"
                              placeholder="Alamat lengkap untuk pengiriman">{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- ACTION --}}
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">
                    <i class="bi bi-save me-1"></i> Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>

<style>
    .card {
    border-radius: 14px;
}

.form-control,
.form-control-lg {
    transition: border-color .2s ease, box-shadow .2s ease;
}

.form-control:focus {
    box-shadow: 0 0 0 .2rem rgba(13,110,253,.15);
}

</style>