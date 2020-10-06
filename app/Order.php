<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo('App\User'); // ta opinia nalezy do jakiegos uzytkownika
    }
    
    public function scopeOrderedDescending($query) // slowo kluczowe scope wykorzystywane przy sortowaniu
    {
       return $query->orderBy('id','desc'); 
    }
    
    // *********** Do Testow *************
    
    public function setUserid($user_id)
    {
        $this->user_id=$user_id;
    }
    
    public function getUserid()
    {
        return $this->user_id;
    }
    
    
    public function setBooks($books)
    {
        $this->books=$books;
    }
    
    public function getBooks()
    {
        return $this->books;
    }
    
    
    
    public function setTotalprice($totalprice)
    {
        $this->totalprice=$totalprice;
    }
    
    public function getTotalprice()
    {
        return $this->totalprice;
    }
    
    
    
    public function setStatus($status)
    {
        $this->status=$status;
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
}
