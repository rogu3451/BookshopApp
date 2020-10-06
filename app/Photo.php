<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    
    public $timestamps = false;
    
    public function photoable()
    {
       return $this->morphTo();  // Obiekt Photos nalezy do jakiegos obiektu (ksiązki lub usera) tak jak w belongsTo(...) ale tu nie wiemy jaki jest to obiekt wiec stosujemy zapis morphTo
    }
    
    public function getPathAttribute($value)
    {
        if((strstr($value,'github')!==False)||(strstr($value,'facebook')!==False))
        {
            return $value;
        }
        elseif((strstr($value,'user')!==False)||(strstr($value,'book')!==False))
        {
            //dd('ma user');
            return asset("storage/{$value}");
        }
        else
        {
            //dd('nie ma user');
            return $value;
        }
        
    }
    
    public function getStoragepathAttribute()
    {
        return $this->original['path'];
    }
    
    // *********** Do Testow *************
    
    public function setPhotoableid($photoable_id)
    {
        $this->photoable_id=$photoable_id;
    }
    
    public function getPhotoableid()
    {
        return $this->photoable_id;
    }
    
    public function setPath($path)
    {
        $this->path=$path;
    }
    
    public function getPath()
    {
        return $this->path;
    }
}
