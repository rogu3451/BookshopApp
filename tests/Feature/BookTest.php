<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Book;

class BookTest extends TestCase
{
   
    
    //** @test */
    public function testThatWeCanGetTitle()
    {
        $book = new Book;
        
        $book->setTitle('Harry Potter');
        
        $this->assertEquals($book->getTitle(),'Harry Potter');

    }
    
    //** @test */
    public function testThatWeCanGetAuthor()
    {
        $book = new Book;
        
        $book->setAuthor('Jan Kowalski');
        
        $this->assertEquals($book->getAuthor(),'Jan Kowalski');

    }
    
     //** @test */
    public function testThatWeCanGetYear()
    {
        $book = new Book;
        
        $book->setYear('1999');
        
        $this->assertEquals($book->getYear(),'1999');

    }
    
    
     //** @test */
    public function testThatWeCanGetPrice()
    {
        $book = new Book;
        
        $book->setPrice('19.99');
        
        $this->assertEquals($book->getPrice(),'19.99');

    }
    
    //** @test */
    public function testThatWeCanGetDescription()
    {
        $book = new Book;
        
        $book->setDescription('xyz');
        
        $this->assertEquals($book->getDescription(),'xyz');

    }
    
    //** @test */
    public function testThatWeCanGetCategory()
    {
        $book = new Book;
        
        $book->setCategory('promocja');
        
        $this->assertEquals($book->getCategory(),'promocja');

    }
    
    
}
