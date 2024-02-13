<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'brand_id',
        'company_name',
        'contact_person',
        'phone_number',
        'company_address',
        'phone',
        'website',
        'logo',
        'fbPage',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

}
