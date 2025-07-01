<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'daftarorder';
    protected $primaryKey = 'idorder';
    public $timestamps = false;

    protected $fillable = [
        'nomerorder', 'iduser', 'tanggalorder', 'jamorder',
        'status', 'statustrack', 'itemsubtotal', 'discon', 'coupon',
        'kodekupon', 'persdiskon', 'tax', 'shippingprice', 'ordertotal'
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'nomerorder', 'nomerorder');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
