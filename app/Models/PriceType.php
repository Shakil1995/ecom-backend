<?php

namespace App\Models;

use App\Models\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function priceType()
    {
        return $this->belongsTo(Price::class);
    }

}
