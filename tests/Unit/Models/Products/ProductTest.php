<?php

namespace Tests\Unit\Models\Products;

use App\Models\Category;
use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
   /** @test */
   function it_uses_the_slug_for_the_route_key_name()
   {
       $product = new Product();
       
       $this->assertEquals($product->getRouteKeyName(), 'slug');
   }
   
   /** @test */
   function it_has_many_categories()
   {
       $product = factory(Product::class)->create();
       
       $product->categories()->save(
           factory(Category::class)->create()
       );
       
       $this->assertInstanceOf(Category::class, $product->categories->first());
   }
}
