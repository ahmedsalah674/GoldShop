<?php

namespace App\Http\Middleware;

use Closure;
use App\Day ;
use App\Dealer_premium ;
use App\Dealer_Quentity ;
use App\Dealing ;
use App\Primare_Sales ;
class destroyOldDate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $years5= \Carbon\Carbon::now()->subDays(30*12*5)->format('Y-m-d');
          $days=Day::whereDate('created_at','<=',$years5)->get();
          foreach($days as $day)
          {
            Day::destroy($day->id);
          }
          $Dealers_Premium=Dealer_Premium::whereDate('created_at','<=',$years5)->get();
          foreach($Dealers_Premium as $Dealer_Premium)
          {
            Dealer_Premium::destroy($Dealer_Premium->id);
          }
          $Dealers_Quentity=Dealer_Quentity::whereDate('created_at','<=',$years5)->get();
          foreach($Dealers_Quentity as $Dealer_Quentity)
          {
            Dealer_Quentity::destroy($Dealer_Quentity->id);
          }
          $Primare_Sales=Primare_Sales::whereDate('created_at','<=',$years5)->get();
          foreach($Primare_Sales as $Primare_Sale)
          {
              Dealing::destroy($Primare_Sales->id);
          }
          $dealings=Dealing::whereDate('created_at','<=',$years5)->get();
          foreach($dealings as $dealing)
          {
            if(!count($dealing->primare))
              Dealing::destroy($dealing->id);
          }
        return $next($request);
    }
}
