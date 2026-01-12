@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">

        {{-- ================= SIDEBAR FILTER ================= --}}
        <div class="col-lg-3 mb-4" id="filterCol">
            <div class="collapse show" id="filterProduk">
                <div class="card border-0 shadow-sm filter-card animate fade-left">

                    <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                        <span>Filter Produk</span>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('catalog.index') }}" method="GET">

                            @if(request('q'))
                                <input type="hidden" name="q" value="{{ request('q') }}">
                            @endif

                            {{-- KATEGORI --}}
                            <div class="mb-4">
                                <h6 class="fw-bold mb-2">Kategori</h6>
                                @foreach($categories as $cat)
                                    <div class="form-check mb-1">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="category"
                                               value="{{ $cat->slug }}"
                                               {{ request('category') == $cat->slug ? 'checked' : '' }}
                                               onchange="this.form.submit()">
                                        <label class="form-check-label">
                                            {{ $cat->name }}
                                            <small class="text-muted">
                                                ({{ $cat->products_count }})
                                            </small>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            {{-- HARGA --}}
                            <div class="mb-4">
                                <h6 class="fw-bold mb-2">Rentang Harga</h6>
                                <div class="d-flex gap-2">
                                    <input type="number" name="min_price"
                                           class="form-control form-control-sm"
                                           placeholder="Min"
                                           value="{{ request('min_price') }}">
                                    <input type="number" name="max_price"
                                           class="form-control form-control-sm"
                                           placeholder="Max"
                                           value="{{ request('max_price') }}">
                                </div>
                            </div>

                            <button class="btn btn-primary w-100 btn-sm">
                                Terapkan Filter
                            </button>

                            <a href="{{ route('catalog.index') }}"
                               class="btn btn-outline-secondary w-100 btn-sm mt-2">
                                Reset
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= PRODUCT GRID ================= --}}
        <div class="col-lg-9" id="productCol">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-4 animate fade-up">
                <div class="d-flex align-items-center gap-2">
                    {{-- TOGGLE FILTER (KIRI) --}}
                    <button id="toggleFilter"
                            class="btn btn-outline-primary btn-sm"
                            data-bs-toggle="collapse"
                            data-bs-target="#filterProduk">
                        Sembunyikan/ Tampilkan Filter
                    </button>

                    <h4 class="mb-0 fw-bold">Katalog Produk</h4>
                </div>

                {{-- SORT --}}
                <form method="GET">
                    @foreach(request()->except('sort') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <select name="sort"
                            class="form-select form-select-sm"
                            onchange="this.form.submit()">
                        <option value="newest">Terbaru</option>
                        <option value="price_asc">Harga Terendah</option>
                        <option value="price_desc">Harga Tertinggi</option>
                    </select>
                </form>
            </div>

            {{-- GRID --}}
            <div id="productGrid"
                 class="row row-cols-2 row-cols-md-4 row-cols-lg-4 g-4">
                @forelse($products as $product)
                    <div class="col animate fade-up">
                        <x-product-card :product="$product" />
                    </div>
                @empty
                    <div class="col-12 text-center py-5 animate zoom-in">
                        <img src="{{ asset('images/empty-state.svg') }}"
                             width="150"
                             class="mb-3 opacity-50">
                        <h5 class="fw-bold">Produk tidak ditemukan</h5>
                        <p class="text-muted">
                            Coba kurangi filter atau gunakan kata kunci lain.
                        </p>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            <div class="mt-4 d-flex justify-content-center animate fade-up">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

{{-- ================= STYLE ================= --}}
<style>
.filter-card{
    border-radius:16px;
}

.animate{
    opacity:0;
    animation:fadeUp .6s ease forwards;
}

.fade-up{animation-name:fadeUp}
.fade-left{animation-name:fadeLeft}
.zoom-in{animation-name:zoomIn}

@keyframes fadeUp{
    from{opacity:0;transform:translateY(25px)}
    to{opacity:1;transform:none}
}
@keyframes fadeLeft{
    from{opacity:0;transform:translateX(-25px)}
    to{opacity:1;transform:none}
}
@keyframes zoomIn{
    from{opacity:0;transform:scale(.95)}
    to{opacity:1;transform:scale(1)}
}
</style>

{{-- ================= SCRIPT ================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const filter = document.getElementById('filterProduk');
    const filterCol = document.getElementById('filterCol');
    const productCol = document.getElementById('productCol');
    const grid = document.getElementById('productGrid');

    filter.addEventListener('hidden.bs.collapse', () => {
        filterCol.classList.add('d-none');
        productCol.classList.remove('col-lg-9');
        productCol.classList.add('col-lg-12');

        grid.classList.remove('row-cols-lg-4');
        grid.classList.add('row-cols-lg-5');
    });

    filter.addEventListener('shown.bs.collapse', () => {
        filterCol.classList.remove('d-none');
        productCol.classList.remove('col-lg-12');
        productCol.classList.add('col-lg-9');

        grid.classList.remove('row-cols-lg-5');
        grid.classList.add('row-cols-lg-4');
    });
});
</script>
