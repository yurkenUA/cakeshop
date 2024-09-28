<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'title',
    ];

    public function products()
    {
        return $this->belongsToMany(Products::class, 'products_tags', 'tag_id', 'product_id');
    }
}
