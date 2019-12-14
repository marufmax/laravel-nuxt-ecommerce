<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryIndexTest extends TestCase
{
    /** @test */
    function it_returns_a_collection_of_categories()
    {
      $categories = factory(Category::class, 2)->create();
      
      $response = $this->json('GET', 'api/categories');
      
      $categories->each(function ($category) use ($response) {
         $response->assertJsonFragment([
             'slug' => $category->slug
         ]);
      });
    }
    
    /** @test */
    function it_only_returns_parent_categories()
    {
        $category = factory(Category::class)->create();
        
        $category->children()->save(
          factory(Category::class)->create()
        );
        
        $this->json('GET', 'api/categories')
            ->assertJsonCount(1, 'data');
    }
    
    /** @test */
    function it_returns_categoris_ordered_by_given_order()
    {
        $category = factory(Category::class)->create(['order' => 2]);
        $anotherCategory = factory(Category::class)->create(['order' => 1]);
    
    
        $this->json('GET', 'api/categories')
            ->assertSeeInOrder([
                $anotherCategory->slug, $category->slug
            ]);
    }
}
