<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Primare_Sales extends Model
{
   protected $table = 'Primare_Sales';
   protected $fillable = [
       'dealing_id','primare_sale',
   ];
   public function sale()
    { 
        return $this->belongsTo('App\Dealing','dealing_id');
    }

}
