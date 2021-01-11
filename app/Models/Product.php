<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ProductScope;

class Product extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    
    protected $hidden = ['created_at','updated_at'];

    protected static function booted()
    {
        static::addGlobalScope(new ProductScope);
    }

}
