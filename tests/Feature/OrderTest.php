<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Order;

class OrderTest extends TestCase
{
    //** @test */
    public function testThatWeCanGetUserid()
    {
        $order = new Order;
        
        $order->setUserid('1');
        
        $this->assertEquals($order->getUserid(),'1');

    } 
    
    //** @test */
    public function testThatWeCanGetBooks()
    {
        $order = new Order;
        
        $order->setBooks('xyz');
        
        $this->assertEquals($order->getBooks(),'xyz');

    } 
    
    //** @test */
    public function testThatWeCanGetTotalprice()
    {
        $order = new Order;
        
        $order->setTotalprice('19.99');
        
        $this->assertEquals($order->getTotalprice(),'19.99');

    }
    
    //** @test */
    public function testThatWeCanGetStatus()
    {
        $order = new Order;
        
        $order->setStatus('opłacono');
        
        $this->assertEquals($order->getStatus(),'opłacono');

    }
}
