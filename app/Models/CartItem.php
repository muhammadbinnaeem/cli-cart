<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->hasOne('App\Models\Product','name','name');
    }

    public function getPriceAttribute()
    {
        return floatval($this->product->price);
    }
}
