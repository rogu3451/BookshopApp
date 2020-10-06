<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    public $timestamps = false;
    
    public function photos()
    {
       return $this->morphMany('App\Photo','photoable'); 
    }
    
    public function opinions()
    {
       return $this->hasMany('App\Opinion'); 
    }
    
  
    
    public function users() // uzytkownicy ktorzy lubia ten obiekt
    {
       return $this->morphToMany('App\User','likeable'); 
    }
    
    public function user() // uzytkownicy ktorzy lubia ten obiekt
    {
       return $this->belongsTo('App\User'); 
    }
    
    public function scopeOrderedDescending($query) // slowo kluczowe scope wykorzystywane przy sortowaniu
    {
       return $query->orderBy('id','desc'); 
    }
    
    public function isLiked()
    {
        return $this->users()->where('user_id',Auth::user()->id)->exists();
    }
    
   
    // **********   Do testow  ***********
    
    public function setTitle($title)
    {
        $this->title=$title;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    
    
    public function setAuthor($author)
    {
        $this->author=$author;
    }
    
    public function getAuthor()
    {
        return $this->author;
    }
    
    
    
    public function setYear($year)
    {
        $this->year=$year;
    }
    
    public function getYear()
    {
        return $this->year;
    }
    
    
    
    public function setPrice($price)
    {
        $this->price=$price;
    }
    
    public function getPrice()
    {
        return $this->price;
    }
    
    public function setDescription($description)
    {
        $this->description=$description;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setCategory($category)
    {
        $this->category=$category;
    }
    
    public function getCategory()
    {
        return $this->category;
    }
   
}
