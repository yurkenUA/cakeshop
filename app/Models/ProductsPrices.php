<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsPrices extends Model
{
    use HasFactory;

    protected $table = 'products_prices';

    protected $fillable = [
        'product_id',
        'size_id',
        'price',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
