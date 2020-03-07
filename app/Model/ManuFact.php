<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ManuFact extends Model
{
    protected $table = 'manu_facts';
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

    ];
}
