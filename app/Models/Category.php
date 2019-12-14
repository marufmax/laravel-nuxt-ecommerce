<?php

namespace App\Models;

use App\Models\Traits\HasChildren;
use App\Models\Traits\IsOrderable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasChildren, IsOrderable;
    
    protected $fillable = [
        'name',
        'order'
    ];
    
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
