<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function products()
    {
        return $this->belongsTo(Product::class)->onDelete('cascade');
    }

    public function tags()
    {
        return $this->belongsTo(Tag::class);
    }
}
