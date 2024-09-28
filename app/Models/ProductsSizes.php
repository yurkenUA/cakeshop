<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsSizes extends Model
{
    use HasFactory;

    protected $table = 'products_sizes';

    protected $fillable = [
        'size',
    ];
}
