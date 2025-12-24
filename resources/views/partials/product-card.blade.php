{{-- ================================================
     FILE: resources/views/partials/product-card.blade.php
     FUNGSI: Komponen kartu produk yang reusable
     ================================================ --}}

<div class="card product-card h-100 border-0">
    {{-- Product Image --}}
    <div class="product-image position-relative">
        <a href="{{ route('catalog.show', $product->slug) }}">
            <img src="{{ $product->image_url }}"
                 alt="{{ $product->name }}">
        </a>

        {{-- Discount Badge --}}
        @if($product->has_discount)
            <span class="badge-discount">
                -{{ $product->discount_percentage }}%
            </span>
        @endif

        {{-- Wishlist --}}
        @auth
            {{-- <button onclick="toggleWishlist({{ $product->id }})"
                    class="wishlist-btn-{{ $product->id }} btn btn-light btn-sm rounded-circle p-2 transition">
                <i class="bi {{ Auth::check() && Auth::user()->hasInWishlist($product) ? 'bi-heart-fill text-danger' : 'bi-heart text-secondary' }} fs-5"></i>
            </button> --}}
            <button type="button"
                    onclick="toggleWishlist({{ $product->id }})"
                    class="btn btn-light btn-sm position-absolute top-0 end-0 m-2 rounded-circle wishslist-btn-{{ $product->id }}">
                <i class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill text-danger' : 'bi-heart' }}"></i>
            </button>
        @endauth
    </div>

    {{-- Card Body --}}
    <div class="card-body d-flex flex-column">
        <small class="product-category">
            {{ $product->category->name }}
        </small>

        <h6 class="product-title">
            <a href="{{ route('catalog.show', $product->slug) }}"
               class="stretched-link">
                {{ Str::limit($product->name, 40) }}
            </a>
        </h6>

        {{-- Price --}}
        <div class="mt-auto">
            @if($product->has_discount)
                <small class="old-price">
                    {{ $product->formatted_original_price }}
                </small>
            @endif
            <div class="product-price">
                {{ $product->formatted_price }}
            </div>

            {{-- Stock --}}
            @if($product->stock <= 5 && $product->stock > 0)
                <small class="stock-warning">
                    <i class="bi bi-exclamation-triangle"></i>
                    Stok {{ $product->stock }}
                </small>
            @elseif($product->stock == 0)
                <small class="stock-danger">
                    <i class="bi bi-x-circle"></i> Stok Habis
                </small>
            @endif
        </div>
    </div>

    {{-- Footer --}}
    <div class="card-footer bg-transparent border-0 pt-0">
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <button class="btn btn-primary btn-sm w-100"
                    @if($product->stock == 0) disabled @endif>
                <i class="bi bi-cart-plus me-1"></i>
                {{ $product->stock == 0 ? 'Stok Habis' : 'Tambah Keranjang' }}
            </button>
        </form>
    </div>
</div>

<style>
    /* =========================
   PRODUCT CARD
========================= */
.product-card {
    border-radius: 20px;
    overflow: hidden;
    background: #ffffff;
    box-shadow: 0 12px 30px rgba(0,0,0,.08);
    transition: transform .3s ease, box-shadow .3s ease;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 22px 55px rgba(0,0,0,.15);
}

/* Image */
.product-image img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    transition: transform .4s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.08);
}

/* Discount badge */
.badge-discount {
    position: absolute;
    top: 12px;
    left: 12px;
    background: linear-gradient(135deg, #ef4444, #f97316);
    color: #fff;
    font-size: .75rem;
    padding: .35rem .7rem;
    border-radius: 50px;
    font-weight: 600;
}

/* Wishlist */
.wishlist-btn {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,.9);
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .2s ease;
}

.wishlist-btn i {
    color: #ef4444;
}

.wishlist-btn:hover {
    background: #ef4444;
}

.wishlist-btn:hover i {
    color: #fff;
}

/* Body */
.product-category {
    font-size: .75rem;
    color: #6b7280;
}

.product-title {
    font-size: .95rem;
    font-weight: 600;
    margin: .25rem 0 .5rem;
}

.product-title a {
    color: #111827;
}

.product-title a:hover {
    color: #4f46e5;
}

/* Price */
.old-price {
    text-decoration: line-through;
    color: #9ca3af;
    font-size: .8rem;
}

.product-price {
    font-size: 1.05rem;
    font-weight: 700;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Stock */
.stock-warning {
    color: #f59e0b;
    font-size: .75rem;
}

.stock-danger {
    color: #ef4444;
    font-size: .75rem;
}

/* Button */
.product-card .btn-primary {
    border-radius: 50px;
}

</style>