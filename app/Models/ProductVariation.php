<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    public function type()
    {
        return $this->hasOne(ProductVariationType::class, 'id', 'type_id');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
