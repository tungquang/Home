<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Provider_Login extends Model
{
    protected $fillable = ['provider','provider_id','user_id'];
    protected $table 	= 'provider_login';

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function findProviderId($provider_id)
    {
    	return self::where('provider_id',$provider_id)->first();
    }
}
