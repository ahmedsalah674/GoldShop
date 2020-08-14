<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealing extends Model
{
    protected $table ='dealings';
    protected $fillable = [
        'name', 'tel', 'weight','caliber','price','type','typetitle','role','day'
    ];  
    public function getWeightAttribute($value)
    {
        return $value.'g';
    }
}
