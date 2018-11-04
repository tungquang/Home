<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
  protected  $fillable = ['id_product','price'];
  protected  $table = "price";

  
}
