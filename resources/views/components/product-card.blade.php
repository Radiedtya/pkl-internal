@props(['product'])

<div class="card product-card h-100 border-0">
    {{-- IMAGE --}}
    <div class="product-image-wrapper">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">

        @if($product->has_discount)
            <span class="discount-badge">
                -{{ $product->discount_percentage }}%
            </span>
        @endif
    </div>

    {{-- CONTENT --}}
    <div class="card-body d-flex flex-column">
        <small class="product-category">{{ $product->category->name }}</small>

        <h6 class="product-title">
            <a href="{{ route('catalog.show', $product->slug) }}" class="stretched-link">
                {{ $product->name }}
            </a>
        </h6>

        <div class="mt-auto product-price">
            @if($product->has_discount)
                <span class="price-discount">{{ $product->formatted_price }}</span>
                <small class="price-original">{{ $product->formatted_original_price }}</small>
            @else
                <span class="price-normal">{{ $product->formatted_price }}</span>
            @endif
        </div>
    </div>
</div>

<style>
/* ================= PRODUCT CARD ================= */
.product-card {
    border-radius: 16px;
    overflow: hidden;
    background: #fff;
    transition: all .25s ease;
}

.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(0,0,0,.12);
}

/* IMAGE */
.product-image-wrapper {
    position: relative;
    width: 100%;
    padding-top: 100%;
    overflow: hidden;
    background: #f8f9fa;
}

.product-image-wrapper img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .4s ease;
}

.product-card:hover img {
    transform: scale(1.08);
}

/* DISCOUNT BADGE */
.discount-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: linear-gradient(135deg, #ff4d4f, #ff7875);
    color: #fff;
    font-size: .75rem;
    font-weight: 600;
    padding: 6px 10px;
    border-radius: 999px;
    box-shadow: 0 4px 12px rgba(255,77,79,.4);
}

/* CONTENT */
.product-category {
    font-size: .75rem;
    font-weight: 600;
    text-transform: uppercase;
    color: #6c757d;
    margin-bottom: 4px;
}

.product-title {
    font-size: .95rem;
    font-weight: 600;
    line-height: 1.4;
    margin-bottom: 10px;
}

.product-title a {
    color: #212529;
    text-decoration: none;
}

.product-title a:hover {
    color: #0d6efd;
}

/* PRICE */
.product-price {
    display: flex;
    flex-direction: column;
}

.price-discount {
    color: #dc3545;
    font-weight: 700;
    font-size: 1rem;
}

.price-original {
    font-size: .8rem;
    text-decoration: line-through;
    color: #adb5bd;
}

.price-normal {
    color: #0d6efd;
    font-weight: 700;
    font-size: 1rem;
}

</style>