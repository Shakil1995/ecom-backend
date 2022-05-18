<?php

namespace App\Models;

use App\Models\Price;
use App\Models\Category;
use App\Models\PriceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'category_id'
    ];
    // private $_getColumns = (['id', 'name', 'is_active']);
    public function category()
    {
        return $this->belongsTo(Category::class,'id','name');
    }

    public function prices()
    {
        return $this->hasMany(Price::class)->with('priceTypes');
    }
}
