<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Role;

class RoleTest extends TestCase
{
    //** @test */
    public function testThatWeCanGetName()
    {
        $role = new Role;
        
        $role->setName('admin');
        
        $this->assertEquals($role->getName(),'admin');

    } 
}
