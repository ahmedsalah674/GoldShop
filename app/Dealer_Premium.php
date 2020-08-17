<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dealer;
class Dealer_Premium extends Model
{
    protected $table = 'dealers_premium';
    protected $fillable =[
        'dealer_id','premium_price','premium_gold',
    ];
    public function dealer()
    {
        return $this->hasOne('App\Dealer');
    }
}
