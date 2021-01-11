<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $appends = [
       'sub_total','discount','total'
    ];

    public function items()
    {
        return $this->hasMany('App\Models\CartItem');
    }

    public function getSubTotalAttribute()
    {
        return $this->items->sum(function ($detail) {
            return $detail->price * $detail->quantity;
        });
    }

    public function getDiscountAttribute()
    {
        $discount_amount = $this->items->sum(function ($detail) {
            $discount = 0;
            if($detail->discount == "buy_2_get_1_free"){
               $discount = intval($detail->quantity / 3);
            }
            else if($detail->discount == "buy_1_get_half_off"){
               $discount = intval($detail->quantity / 2);
               $discount = $discount * 0.5;
            }
            return $detail->price * ($detail->quantity - $discount);
        });

        return $this->sub_total - $discount_amount;
    }

    public function getTotalAttribute()
    {
        return $this->sub_total - $this->discount;
    }
}
