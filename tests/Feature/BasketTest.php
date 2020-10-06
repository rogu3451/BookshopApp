<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Basket;

class BasketTest extends TestCase
{

     //** @test */
    public function testThatWeCanGetBookid()
    {
        $basket = new Basket;
        
        $basket->setBookid('1');
        
        $this->assertEquals($basket->getBookid(),'1');

    }
    
      //** @test */
    public function testThatWeCanGetUserid()
    {
        $basket = new Basket;
        
        $basket->setUserid('1');
        
        $this->assertEquals($basket->getUserid(),'1');

    }
}
