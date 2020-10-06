<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
     //** @test */
    public function testThatWeCanGetName()
    {
        $user = new User;
        
        $user->setName('Jan');
        
        $this->assertEquals($user->getName(),'Jan');

    }
    
     //** @test */
    public function testThatWeCanGetSurname()
    {
        $user = new User;
        
        $user->setSurname('Kowalski');
        
        $this->assertEquals($user->getSurname(),'Kowalski');

    }
    
     //** @test */
    public function testThatWeCanGetEmail()
    {
        $user = new User;
        
        $user->setEmail('kowalski@wp.pl');
        
        $this->assertEquals($user->getEmail(),'kowalski@wp.pl');

    }
    
    
}
