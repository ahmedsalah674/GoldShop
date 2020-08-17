<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dealer_Quentity;
class Dealer extends Model
{
    protected $table ='dealers';
    protected $fillable = [
        'name', 'tel',
    ];
    public function quantity()
    {
        return $this->hasMany('App\Dealer_Quentity','dealer_id');
    }
    public function Premiums()
    {
        return $this->hasMany('App\Dealer_Premium','dealer_id');
    } 
}
