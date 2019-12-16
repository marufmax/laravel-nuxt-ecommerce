<?php

namespace Tests\Unit\Products;

use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;
use Tests\TestCase;

class ProductVariationTest extends TestCase
{
    /** @test */
    function it_has_one_variation_type()
    {
        $variation = factory(ProductVariation::class)->create();
        
        $this->assertInstanceOf(ProductVariationType::class, $variation->type);
    }
    
    /** @test */
    function it_belongs_to_a_product()
    {
        $variation = factory(ProductVariation::class)->create();
        
        $this->assertInstanceOf(Product::class, $variation->product);
    }
}
