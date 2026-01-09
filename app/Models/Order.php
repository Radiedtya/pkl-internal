<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    // Table name
    protected $table = 'orders';
    // Primary key
    protected $primaryKey = 'id';

    // Mass assignable attributes
    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'payment_status',
        'shipping_name',
        'shipping_address',
        'shipping_phone',
        'total_amount',
        'shipping_cost',
        'snap_token',
    ];
    // Cast ke tipe data yang sesuai
    protected $casts = [
        'subtotal' => 'integer',
        'shipping_cost' => 'integer',
        'total_amount' => 'integer',
    ];
    // ==================== RELATIONSHIPS ====================

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // Relasi ke OrderItem
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

}
