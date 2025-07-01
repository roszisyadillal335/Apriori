<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'daftarorderdetail'; // nama tabel jika tidak default
    protected $primaryKey = 'idproduct';
    public $timestamps = false;

    protected $fillable = ['namaproduk', 'hargaproduk', 'gambar'];

}