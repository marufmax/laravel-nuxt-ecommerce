<?php

namespace App\Models;

use App\Scoping\Scoper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    
    public function scopeWithScopes(Builder $builder, array $scopes = [])
    {
        return (new Scoper(request()))->apply($builder, $scopes);
    }
}
