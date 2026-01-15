@extends('layouts.app')

@section('content')
<div class="container py-5 catalog-wrapper">

    {{-- ================= PAGE HEADER ================= --}}
    <div class="card glass mb-5 animate fade-up mx-auto shadow-lg border-0">
        <div class="my-4 text-center">
            <h2 class="fw-bold display-6">Katalog Produk</h2>
            <p class="text-muted mb-0">
                Jelajahi berbagai produk menarik yang kami tawarkan.
            </p>
        </div>
    </div>

    {{-- ================= TOP BAR ================= --}}
    <div class="row mb-3 animate fade-up align-items-center">

        {{-- TOGGLE FILTER --}}
        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
            <button id="toggleFilter"
                    class="btn btn-outline-primary btn-sm w-100"
                    data-bs-toggle="collapse"
                    data-bs-target="#filterProduk">
                Sembunyikan / Tampilkan Filter
            </button>
        </div>

        {{-- SORT --}}
        <div class="col-12 col-lg-9 text-lg-end">
            <form method="GET" class="d-inline-block">
                @foreach(request()->except('sort') as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                <select name="sort"
                        class="form-select form-select-sm"
                        onchange="this.form.submit()">
                    <option value="newest" {{ request('sort')=='newest'?'selected':'' }}>Terbaru</option>
                    <option value="price_asc" {{ request('sort')=='price_asc'?'selected':'' }}>Harga Terendah</option>
                    <option value="price_desc" {{ request('sort')=='price_desc'?'selected':'' }}>Harga Tertinggi</option>
                </select>
            </form>
        </div>
    </div>

    <div class="row">

        {{-- ================= FILTER SIDEBAR ================= --}}
        <div class="col-lg-3 mb-4" id="filterCol">
            <div class="collapse show" id="filterProduk">
                <div class="card glass filter-card shadow-lg animate fade-left border-0">

                    <div class="card-header bg-transparent fw-bold">
                        Filter Produk
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
                                    <div class="form-check mb-2">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="category"
                                               value="{{ $cat->slug }}"
                                               {{ request('category') == $cat->slug ? 'checked' : '' }}
                                               onchange="this.form.submit()">
                                        <label class="form-check-label">
                                            <span>{{ $cat->name }}</span>
                                            <small class="badge bg-dark">
                                                {{ $cat->products_count }}
                                            </small>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            {{-- HARGA --}}
                            <div class="mb-4">
                                <h6 class="fw-bold mb-2">Rentang Harga</h6>
                                <div class="d-flex gap-2">
                                    <input type="number"
                                           name="min_price"
                                           class="form-control form-control-sm"
                                           placeholder="Min"
                                           value="{{ request('min_price') }}">
                                    <input type="number"
                                           name="max_price"
                                           class="form-control form-control-sm"
                                           placeholder="Max"
                                           value="{{ request('max_price') }}">
                                </div>
                            </div>

                            <button class="btn btn-primary btn-sm w-100">
                                Terapkan Filter
                            </button>

                            <a href="{{ route('catalog.index') }}"
                               class="btn btn-outline-secondary btn-sm w-100 mt-2">
                                Reset
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= PRODUCT GRID ================= --}}
        <div class="col-lg-9" id="productCol">

            <div id="productGrid"
                 class="row row-cols-2 row-cols-md-4 row-cols-lg-4 g-4">

                @forelse($products as $product)
                    <div class="col animate fade-up">
                        <x-product-card :product="$product" />
                    </div>
                @empty
                    <div class="col-12 text-center py-5 animate zoom-in empty-state">
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
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

{{-- ================= STYLE ================= --}}
<style>
:root{
    --glass:rgba(255,255,255,.75);
    --blur:blur(14px);
}

.catalog-wrapper{
    background:linear-gradient(180deg,#f8fafc,#eef2f7);
    border-radius:24px;
}

.glass{
    background:var(--glass);
    backdrop-filter:var(--blur);
    -webkit-backdrop-filter:var(--blur);
    border:1px solid rgba(255,255,255,.4);
}

.card{border-radius:20px}

.filter-card{
    transition:.35s ease;
}
.filter-card:hover{
    transform:translateY(-4px);
    box-shadow:0 20px 40px rgba(0,0,0,.08);
}

.form-check-label{
    display:flex;
    justify-content:space-between;
    width:100%;
    cursor:pointer;
}

.btn{border-radius:12px}

.btn-primary{
    box-shadow:0 8px 20px rgba(13,110,253,.25);
}

select.form-select{
    border-radius:14px;
    padding:.45rem .75rem;
}

.animate{
    opacity:0;
    animation:fadeUp .7s cubic-bezier(.4,0,.2,1) forwards;
}

.fade-up{animation-name:fadeUp}
.fade-left{animation-name:fadeLeft}
.zoom-in{animation-name:zoomIn}

@keyframes fadeUp{
    from{opacity:0;transform:translateY(30px)}
    to{opacity:1;transform:none}
}
@keyframes fadeLeft{
    from{opacity:0;transform:translateX(-30px)}
    to{opacity:1;transform:none}
}
@keyframes zoomIn{
    from{opacity:0;transform:scale(.92)}
    to{opacity:1;transform:scale(1)}
}

.empty-state img{
    animation:float 3s ease-in-out infinite;
}

@keyframes float{
    0%,100%{transform:translateY(0)}
    50%{transform:translateY(-10px)}
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
