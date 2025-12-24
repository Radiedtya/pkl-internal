<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    // Relasi ke Produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke Order  
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // accessor untuk mendapatkan subtotal item (harga * jumlah)
    
    public function getSubtotalAttribute(): int
    {
        return $this->quantity * $this->price;
    }
}
