<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsImages extends Model
{
    use HasFactory;

    protected $table = 'products_images';
    public $timestamps = false;


    protected $fillable = [
        'product_id',
        'image_id',
        'priority',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function image()
    {
        return $this->belongsTo(Images::class, 'image_id');
    }
}
