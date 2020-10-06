<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Twojaksiegarnia\Presenters\UserPresenter;
    
    
    public static $roles = []; // zastosowanie zmiennej statycznej aby nie laczyc sie za kazdym razem z baza
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'surname', 'provider_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function books() // co użytkownik lubi
    {
        return $this->morphedByMany('App\Book','likeable');
    }
    
    public function photos() // fotografie uzytkownika
    {
        return $this->morphMany('App\Photo','photoable');
    }
    
    public function opinions() // uzytkownik ma wiele dodanych opini 
    {
        return $this->hasMany('App\Opinion');
    }
    
    public function orders() // uzytkownik ma wiele dodanych opini 
    {
        return $this->hasMany('App\Order');
    }
    
    public function unotifications() // uzytkownik ma wiele powiadomien
    {
        return $this->hasMany('App\Notification');
    }
    
     public function roles()
    {
       return $this->belongsToMany('App\Role'); 
    }
    
    public function hasRole(array $roles)
    {
        foreach($roles as $role)
        {
            if(isset(self::$roles[$role]))
            {
                if(self::$roles[$role]) return true;
            }
            else
            {
                self::$roles[$role] = $this->roles()->where('name',$role)->exists();
                
                if(self::$roles[$role]) return true;
            }
        }
        return false;
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
    
    
    public function setSurname($surname)
    {
        $this->surname=$surname;
    }
    
    public function getSurname()
    {
        return $this->surname;
    } 
    
    public function setEmail($email)
    {
        $this->email=$email;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
   
   
}
