<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    public $timestamps = false;
    
    public function book()
    {
       return $this->belongsTo('App\Book'); 
    }
    
     // *********** Do Testow *************
    
    public function setBookid($bookid)
    {
        $this->book_id=$bookid;
    }
    
    public function getBookid()
    {
        return $this->book_id;
    }
    
    public function setUserid($userid)
    {
        $this->user_id=$userid;
    }
    
    public function getUserid()
    {
        return $this->user_id;
    }
    
}
