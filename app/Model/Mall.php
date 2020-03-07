<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
  protected $table = 'malls';
  protected $fillable = [

    'name_ar',
    'name_en',
    'mobile',
    'email',
    'facebook',
    'twitter',
    'website',
    'connect_name',
    'lat',
    'lng',
    'icon',
    'address',
    'country_id',

  ];

  public function country_id(){
    return $this->hasOne('App\Model\Country','id','country_id');
  }
}
