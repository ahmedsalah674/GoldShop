<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dealer;
class Dealer_Quentity extends Model
{
    protected $table ='dealers_quentity';
    protected $fillable =[
        'weight','price','typetitle','caliber','dealer_id',
    ];
    public function dealer(Type $var = null)
    {
        return $this->hasOne('Dealer');
    }
}
