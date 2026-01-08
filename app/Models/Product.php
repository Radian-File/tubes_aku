<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama',
        'merk',
        'harga',
        'ukuran',
        'gambar',
        'deskripsi',
        'stok',
        'status_pesanan',
        'kategori',
        'kode_produk'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
