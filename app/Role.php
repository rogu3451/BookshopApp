<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $quarded = [];
    public $timestamps = false;
    
    public function users()
    {
       return $this->belongsToMany('App\User'); 
    }



// *********** Do Testow *************
    
    public function setName($name)
    {
        $this->name=$name;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
}