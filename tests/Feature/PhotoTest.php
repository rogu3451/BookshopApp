<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Photo;

class PhotoTest extends TestCase
{
     //** @test */
    public function testThatWeCanGetPhotoableid()
    {
        $photo = new Photo;
        
        $photo->setPhotoableid('1');
        
        $this->assertEquals($photo->getPhotoableid(),'1');

    } 
    
     //** @test */
    public function testThatWeCanGetPath()
    {
        $photo = new Photo;
        
        $photo->setPath('xyz');
        
        $this->assertEquals($photo->getPath(),'xyz');

    } 
    
    
}
