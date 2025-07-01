<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'daftarorderdetail';
    protected $primaryKey = 'idorderdetail';
    public $timestamps = false;

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

    public function order()
    {
        return $this->belongsTo(Order::class, 'nomerorder', 'nomerorder');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'idproduct');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
