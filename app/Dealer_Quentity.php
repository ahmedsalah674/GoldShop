<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealer_Quentity extends Model
{
    protected $table ='dealers_quentity';
    protected $fillable =[
        'weight','price','typetitle','caliber','dealer_id',
    ];
}
