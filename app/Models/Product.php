<?php
// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'stock',
        'weight',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    // ==================== BOOT ====================

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);

                // Pastikan slug unik
                $count = static::where('slug', 'like', $product->slug . '%')->count();
                if ($count > 0) {
                    $product->slug .= '-' . ($count + 1);
                }
            }
        });

        // logika untuk updating slug jika nama berubah
        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
                $count = static::where('slug', 'like', $product->slug . '%')
                    ->where('id', '!=', $product->id)
                    ->count();
                if ($count > 0) {
                    $product->slug .= '-' . ($count + 1);
                }
            }
        });
    }

    // ==================== RELATIONSHIPS ====================

    /**
     * Produk termasuk dalam satu kategori.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Produk memiliki banyak gambar.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    /**
     * Gambar utama produk.
     */
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    /**
     * Item pesanan yang mengandung produk ini.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // ==================== ACCESSORS ====================

    /**
     * Harga yang ditampilkan (diskon atau normal).
     */
    /**
     * ACCESSOR: Harga yang ditampilkan (bisa diskon atau normal)
     *
     * Accessor adalah property VIRTUAL yang dihitung saat diakses.
     * Tidak ada di database, tapi bisa diakses seperti kolom biasa.
     *
     * PENAMAAN:
     * get{NamaAttribute}Attribute
     * getDisplayPriceAttribute -> $product->display_price
     *
     * CARA PAKAI:
     * $product->display_price   // 120000 (kalau diskon)
     *                           // 150000 (kalau tidak diskon)
     */
    public function getDisplayPriceAttribute(): float
    {
        // Cek apakah ada harga diskon DAN diskon lebih murah dari harga normal
        if ($this->discount_price !== null && $this->discount_price < $this->price) {
            return (float) $this->discount_price;
        }
        // Jika tidak ada diskon, return harga normal
        return (float) $this->price;
    }

    /**
     * Format harga untuk tampilan.
     * Contoh: Rp 1.500.000
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->display_price, 0, ',', '.');
    }


    /**
     * Format harga asli (sebelum diskon).
     */
    public function getFormattedOriginalPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * ACCESSOR: Persentase diskon.
     *
     * CARA PAKAI:
     * "Diskon {{ $product->discount_percentage }}%"  // "Diskon 20%"
     */
    public function getDiscountPercentageAttribute(): int
    {
        if (!$this->has_discount) {
            return 0;
        }
        // Rumus: ((Harga Asli - Harga Diskon) / Harga Asli) * 100
        // Contoh: ((150000 - 120000) / 150000) * 100 = 20%
        return round((($this->price - $this->discount_price) / $this->price) * 100);
    }

    /**
     * ACCESSOR: Cek apakah produk punya diskon.
     *
     * CARA PAKAI:
     * @if($product->has_discount)
     *     <span>SALE!</span>
     * @endif
     */
    public function getHasDiscountAttribute(): bool
    {
        return $this->discount_price !== null
            && $this->discount_price < $this->price;
        // True jika:
        // 1. discount_price tidak null (ada diisi)
        // 2. DAN discount_price lebih kecil dari price (benar-benar diskon)
    }

    /**
     * URL gambar utama atau placeholder.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->primaryImage) {
            return $this->primaryImage->image_path;
        }
        return asset('images/no-image.png');
    }

    /**
     * Cek apakah produk tersedia (aktif dan ada stok).
     */
    public function getIsAvailableAttribute(): bool
    {
        return $this->is_active && $this->stock > 0;
    }

    // ==================== SCOPES ====================

    /**
     * Filter produk aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Filter produk unggulan.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * SCOPE: Filter produk yang sedang diskon
     *
     * CARA PAKAI:
     * Product::onSale()->get()  // Semua produk diskon
     */
    public function scopeOnSale($query)
    {
        return $query->whereNotNull('discount_price')
                     ->whereColumn('discount_price', '<', 'price');
        // ↑ whereColumn() membandingkan 2 kolom di database
        //   Berbeda dengan where() yang membandingkan kolom dengan nilai
    }

    /**
     * Filter produk yang tersedia (ada stok).
     */
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    /**
     * Filter berdasarkan kategori (menggunakan slug).
     */
    public function scopeByCategory($query, string $categorySlug)
    {
        return $query->whereHas('category', function($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    /**
     * Pencarian produk.
     */
    public function scopeSearch($query, string $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('name', 'like', "%{$keyword}%")
              ->orWhere('description', 'like', "%{$keyword}%");
        });
    }

    /**
     * Filter berdasarkan range harga.
     */
    public function scopePriceRange($query, float $min, float $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }
}