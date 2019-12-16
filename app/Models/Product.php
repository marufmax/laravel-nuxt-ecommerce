<?php

namespace App\Models;

use App\Models\Traits\CanBeScoped;
use App\Models\Traits\HasPrice;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CanBeScoped, HasPrice;
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    
    public function variations()
    {
        return $this->hasMany(ProductVariation::class)
            ->orderBy('order');
    }
}
