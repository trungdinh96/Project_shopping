<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function tags()
    {
        return $this
        ->belongsToMany(Tag::class,'product_tags','product_id','tag_id')
        ->withTimestamps();
    }
    public function categorys()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    
}
