<?php

namespace App\Twojaksiegarnia\Presenters;


trait UserPresenter  {
    
    public function getFullNameAttribute()
    {
        return $this->name. ' '.$this->surname;
    }
    
    
}