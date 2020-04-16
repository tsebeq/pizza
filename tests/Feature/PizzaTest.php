<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PizzaTest extends TestCase
{
    use WithoutMiddleware;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanSeePizzasList()
    {
        $response = $this->get('/pizza');

        $response->assertStatus(200);
    }
}
