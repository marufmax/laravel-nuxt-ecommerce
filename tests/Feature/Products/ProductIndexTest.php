<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductIndexTest extends TestCase
{
    /** @test */
    function it_shows_collection_of_products()
    {
        $product = factory(Product::class)->create();
        
        $this->json('GET', 'api/products')
            ->assertJsonFragment([
                'id'   => $product->id,
                'slug'   => $product->slug,
                'price'   => $product->price
            ]);
    }
    
    /** @test */
    function it_has_paginated_data()
    {
        $this->json('GET', 'api/products')
            ->assertJsonStructure([
                'data',
                'links',
                'meta'
            ]);
    }
}
