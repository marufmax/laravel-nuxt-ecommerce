<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ProductVariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->resource instanceof Collection) {
            return ProductVariationResource::collection($this->resource);
        }
        
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'price'         => $this->formattedPrice,
            'price_varies'  => $this->priceVaries(),
            'order'         => $this->order,
            'stock_count'   => (int) $this->stockCount(),
            'in_stock'      => $this->inStock()
        ];
    }
}
