<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Opinion;

class OpinionTest extends TestCase
{
    
    //** @test */
    public function testThatWeCanGetContent()
    {
        $opinion = new Opinion;
        
        $opinion->setContent('xyz');
        
        $this->assertEquals($opinion->getContent(),'xyz');

    }

    
    //** @test */
    public function testThatWeCanGetUserid()
    {
        $opinion = new Opinion;
        
        $opinion->setUserid('1');
        
        $this->assertEquals($opinion->getUserid(),'1');

    }
}
