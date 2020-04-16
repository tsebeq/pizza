<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IngredientTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanSeeIngredients()
    {
        $ingredient = factory('App\Ingredient')->create();
        
        $response = $this->get('/ingredient');
        $response->assertSee($ingredient->name);
        $response->assertStatus(200);
    }
    
    public function testUserCanEditIngredients()
    {
        $ingredient = factory('App\Ingredient')->create();
        
        $response = $this->get('/ingredient/' . $ingredient->name);
        $response->assertSee($ingredient->name);
        $response->assertStatus(200);
    }
    
    public function testUserCanRemoveIngredients()
    {
        $ingredient = factory('App\Ingredient')->create();
        
        $response = $this->get('/ingredient/remove/' . $ingredient->id);
        $response->assertStatus(302);
    }
}
