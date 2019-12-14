<?php


namespace App\Models\Traits;


use Illuminate\Database\Eloquent\Builder;

trait IsOrderable
{
    public function scopeOrdered(Builder $builder, string $direction = 'asc'): Builder
    {
        return $builder->orderBy('order', $direction);
    }
}