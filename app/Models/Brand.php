<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        "brand_name", "brand_image"
    ];
    public function vendors() {
        return $this->hasMany(Vendor::class);
    }
    
}
