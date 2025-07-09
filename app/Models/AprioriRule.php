<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AprioriRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'lhs',
        'rhs',
        'support',
        'confidence',
    ];
}
