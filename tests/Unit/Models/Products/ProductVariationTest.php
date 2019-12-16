<?php

namespace Tests\Unit\Products;

use App\Cart\Money;
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
    
    /** @test */
    function it_returns_a_money_instance_for_the_price()
    {
        $variation = factory(ProductVariation::class)->create();
        
        $this->assertInstanceOf(Money::class, $variation->price);
    }
    
    /** @test */
    function it_returns_a_formatted_price()
    {
        $variation = factory(ProductVariation::class)->create([
            'price' => 1000
        ]);
        
        $this->assertEquals($variation->formattedPrice, 'BDT 10.00');
    }
    
    /** @test */
    function it_returns_a_produdct_price_if_price_is_missing()
    {
        $product = factory(Product::class)->create([
            'price' => 100
        ]);
        
        $variation = factory(ProductVariation::class)->create([
            'product_id' => $product->id,
            'price' => null
        ]);
        
        $this->assertEquals($product->price->amount, $variation->price->amount);
    }
    
    /** @test */
    function it_can_check_if_variation_price_is_different_to_product()
    {
        $product = factory(Product::class)->create([
            'price' => 1000
        ]);
    
        $variation = factory(ProductVariation::class)->create([
            'product_id' => $product->id,
            'price' => 500
        ]);
        
        $this->assertTrue($variation->priceVaries());
    }
}
