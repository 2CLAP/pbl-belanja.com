<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'discount_price'
    ];

    protected $hidden = [
        
    ];

    public function products() {
        return $this->hasMany(Product::class, 'tags_id', 'id');
    }
}
