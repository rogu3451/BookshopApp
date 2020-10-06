<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Opinion extends Model
{
    use Twojaksiegarnia\Presenters\OpinionPresenter;
    
    
    public $timestamps = false;
    
    public function opinionable()
    {
        return $this->morphTo(); 
    }
    
    public function user()
    {
        return $this->belongsTo('App\User'); // ta opinia nalezy do jakiegos uzytkownika
    }
    
    // *********** Do Testow *************
    
    public function setContent($content)
    {
        $this->content=$content;
    }
    
    public function getContent()
    {
        return $this->content;
    }
    
    
    public function setUserid($user_id)
    {
        $this->user_id=$user_id;
    }
    
    public function getUserid()
    {
        return $this->user_id;
    }
}
