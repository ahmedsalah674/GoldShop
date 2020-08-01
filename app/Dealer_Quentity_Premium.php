<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealer_Quentity_Premium extends Model
{
    protected $table = 'dealers_quentity_premium';
    protected $fillable =[
        'quantity_id','premium_price','premium_gold',
    ];
}
