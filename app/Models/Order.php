<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Jika nama tabel tidak sesuai konvensi (orders), bisa didefinisikan secara eksplisit:
    // protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'product_id',
        'status',
        'total_harga',
        'tanggal_pesan',
        'alamat',
        'quantity',
        'payment_method',
    ];

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relasi ke model Review.
     */
    public function review()
    {
        return $this->hasOne(Review::class);
    }
}

