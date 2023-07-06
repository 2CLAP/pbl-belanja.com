<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'categories_id',
        'price',
        'description',
        'slug',
        'stock',
        'tags_id',
        'discount_price',
    ];

    protected $hidden = [
        
    ];

    public function galleries() {
        return $this->hasMany(ProductGallery::class, 'products_id', 'id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }

    public function tag() {
       return $this->belongsTo(Tag::class, 'tags_id', 'id');
    }

    public function getDiscountPrice() {
        if ($this->tags) {
            return $this->tags->discount_price;
        }
        
        return $this->price;
    }
}
