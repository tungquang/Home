<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Price;
use App\Model\Size;

class Product extends Model
{
    protected $fillable = [
    	'name','quantily','code','image',
    ];
    protected $table = 'products';

  public function getPrice()
  {
  	return $this->hasMany('App\Model\Price','id_product','id');
  }

  public function getShortName($shorname)
  {
  	return self::where('code',$shorname)->first();
  }
  public function getSize()
  {
    return $this->hasMany('App\Model\Size','id_product','id');
  }

}
