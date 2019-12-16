<?php

namespace Tests\Unit\Categories;

use App\Models\Category;
use App\Models\Product;
use Tests\TestCase;

class CategoryTest extends TestCase
{
   /** @test */
   function it_has_many_children()
   {
       $category = factory(Category::class)->create();
       
       $category->children()->save(
           factory(Category::class)->create()
       );
       
       $this->assertInstanceOf(Category::class, $category->children->first());
   }
    
    /** @test */
    function it_can_fetch_only_parents()
    {
        $category = factory(Category::class)->create();
        
        $category->children()->save(
            factory(Category::class)->create()
        );
        
        $this->assertEquals(1, Category::parents()->count());
    }
    
    /** @test */
    function it_is_orderable_by_a_numbered_order()
    {
        $category = factory(Category::class)->create(['order' => 2]);
        
        $anotherCategory = factory(Category::class)->create(['order' => 1]);
        
        
        $this->assertEquals($anotherCategory->name, Category::ordered()->first()->name);
    }
    
    /** @test */
    function it_has_many_products()
    {
        $category = factory(Category::class)->create();
    
        $category->products()->save(
            factory(Product::class)->create()
        );
        
        $this->assertInstanceOf(Product::class, $category->products()->first());
    }
}
