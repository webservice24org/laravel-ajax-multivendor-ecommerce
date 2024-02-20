<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'product_category_name', 
        'product_category_slug', 
        'category_image', 
        'category_desc'
    ];

    public function products() {
        return $this->belongsToMany(Product::class, 'product_category');
    }
    
}
