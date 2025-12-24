<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    // Relasi ke Produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke Keranjang  
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }


    // accessor untuk mendapatkan subtotal item (harga * jumlah)
    
    public function getSubtotalAttribute(): int
    {
        return $this->quantity * $this->product->price;
    }
}
