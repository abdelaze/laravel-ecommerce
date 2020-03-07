<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{



      protected $table = 'products';
      protected $fillable = [
        'title',
        'photo',
        'content',
        'dep_id',
        'trade_id',
        'manufact_id',
        'currency_id',
        'color_id',
        'size_id',
        'weight',
        'stock',
        'price',
        'start_at',
        'end_at',
        'start_offer_at',
        'end_offer_at',
        'offer_price',
        'weight_id',
        'other_data',
        'status',
        'reason',

      ];

}
