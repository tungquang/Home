<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /*   To get user by id or email
    *  If return user null with email then return user with id
    */
    public function findEmailOrId($value)
    {
        if($this->find($value))
        {
            return $this->find($value);
        }
        return self::where('email',$value)->first();
    }
}
