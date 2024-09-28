<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'title',
        'altname',
        'description',
        'meta_description',
        'main_image_id',
        'ingredients',
        'is_gluten_free',
        'is_customazable',
    ];

    public function prices()
    {
        return $this->hasMany(ProductsPrices::class, 'product_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'products_tags', 'product_id', 'tag_id');

    }

    protected function getTagsPluckedAttribute()
    {
        return $this->tags->pluck('title', 'id')->toArray();
    }

    public function images()
    {
        return $this->hasManyThrough(
            Images::class, // deployment table
            ProductsImages::class, // environment table
            'product_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'image_id' // Local key on the environments table...
        )->orderBy('priority', 'ASC');
    }

    protected function getImagesWithPriorityAttribute()
    {
        return $this->images->map(function($item, $key) {
            $item->priority = $key;
            return $item;
        })->toArray();
    }
}
