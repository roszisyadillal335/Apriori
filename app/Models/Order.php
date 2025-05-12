<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'daftarorder'; // Nama tabel di database

    protected $primaryKey = 'idorder'; // Primary key kustom

    public $timestamps = false; // Karena tidak ada kolom created_at dan updated_at

    protected $fillable = [
        'nomerorder',
        'iduser',
        'tanggalorder',
        'jamorder',
        'status',
        'statustrack',
        'itemsubtotal',
        'discon',
        'coupon',
        'kodekupon',
        'persdiskon',
        'tax',
        'shippingprice',
        'ordertotal'
    ];

    // Relasi ke OrderDetail
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'nomerorder', 'nomerorder');
    }
}
