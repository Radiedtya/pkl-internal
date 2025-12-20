<?php
// app/Observers/ProductObserver.php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        // Clear cache
        Cache::forget('featured_products');
        Cache::forget('category_' . $product->category_id . '_products');

        // Skip activity log saat seeding / console
        if (app()->runningInConsole() || !Auth::check()) {
            return;
        }

        // Log activity
        activity()
            ->performedOn($product)
            ->causedBy(Auth::user())
            ->log('Produk baru dibuat: ' . $product->name);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        Cache::forget('product_' . $product->id);
        Cache::forget('featured_products');

        if ($product->isDirty('category_id')) {
            Cache::forget('category_' . $product->getOriginal('category_id') . '_products');
            Cache::forget('category_' . $product->category_id . '_products');
        }

        // Optional: log update activity
        if (!app()->runningInConsole() && Auth::check()) {
            activity()
                ->performedOn($product)
                ->causedBy(Auth::user())
                ->log('Produk diperbarui: ' . $product->name);
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        Cache::forget('product_' . $product->id);
        Cache::forget('featured_products');
        Cache::forget('category_' . $product->category_id . '_products');

        // Optional: log delete activity
        if (!app()->runningInConsole() && Auth::check()) {
            activity()
                ->performedOn($product)
                ->causedBy(Auth::user())
                ->log('Produk dihapus: ' . $product->name);
        }
    }
}
