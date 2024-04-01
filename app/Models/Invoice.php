<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'price',
        'qty',
        'tax',
        'net',
        'total',
        'discount',
        'product_id',
        'product_name',
        'user_id',
        'username'

    ];
}
