<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }
    
    public function categories() {
        return $this->belongsToMany(ProductCategory::class, 'product_category');
    }
    
    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }
    
}
