<?php

namespace App\Http\Controllers\Buy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dealing;
use Carbon\Carbon;
class BuyController extends Controller
{
   public function displaydaily()
   {
      // $now=Carbon\Carbon::now()->format('m-d-Y');
     // dd($now);
     $buys=Dealing::where('role',1)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->paginate(10);
   //   dd($buys);
     return view('Buys.displaydailybuy',compact('buys'));
   }
    public function buyform()
    {
       return view('Buys.buyform');
    }
    public function storebuy(Request $request)
    {
      $now=\Carbon\Carbon::now()->format('m-d-Y');
      Dealing::create([
         'name' => $request->name,
         'tel' => $request->tel,
         'weight' => $request->weight,
         'caliber' => $request->caliber,
         'price' => $request->price,
         'type' => 0,
         'typetitle' => $request->typetitle,
         'day'=>$now,
         'role' => 1,
       ]);
        return redirect()->route('home');
    }
    public function display(Request $request)
    {
      $buy=Dealing::find($request->id);
       return view('Buys.display',compact('buy'));
    }
    public function editbuy(Request $request)
    {
      $buy=Dealing::find($request->id);
       return view('Buys.editbuy',compact('buy'));
    }
    public function updatebuy(Request $request)
    {
        dd($request);
       return redirect()->route('home');
    }
    
    
}
