<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'daftarorderdetail'; // Nama tabel di database

    protected $primaryKey = 'idorderdetail'; // Primary key

    public $timestamps = false; // Tidak ada kolom created_at dan updated_at

    protected $fillable = [
        'nomerorder',
        'idproduct',
        'iduser',
        'namaproduk',
        'gambar',
        'discon',
        'txtdiskon',
        'tax',
        'hargaproduk',
        'hargabelumdiskon',
        'qty',
        'subtotalproduk'
    ];

    // Relasi ke Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'nomerorder', 'nomerorder');
    }
}
