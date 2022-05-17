<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends Model
{
  
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'price_type_id'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function priceTypes()
    {
        return $this->hasMany(PriceType::class);
    }
}
