<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dealing;
class SalesController extends Controller
{
   public function display(Request $request)
    {
      $sale=Dealing::find($request->id);
       return view('Sales.display',compact('sale'));
    }
   public function displaydaily()
    {
       $now=\Carbon\Carbon::now()->format('m-d-Y');
      // dd($now);
      $sales=Dealing::where('role',0)->where('day',$now)->paginate(10);
      return view('Sales.displaydailysales',compact('sales'));
    }
    public function salesform()
    {
       return view('Sales.salesform');
    }
    public function storesales(Request $request)
    {
      $now=\Carbon\Carbon::now()->format('m-d-Y');
      // dd($now-1);

      Dealing::create([
        'name' => $request->name,
        'tel' => $request->tel,
        'weight' => $request->weight,
        'caliber' => $request->caliber,
        'price' => $request->price,
        'type' => $request->type,
        'typetitle' => $request->typetitle,
        'day'=>$now,
        'role' => 0,
      ]);
       return redirect()->back()->with('message','تم تسجيل العملية ');
    }
    public function editsales(Request $request)
    {
       $sale=Dealing::find($request->id);
      //  dd($sale);
       return view('Sales.editsales',compact('sale'));
    }
    public function updatesales(Request $request)
    {
        dd($request);
       return redirect()->route('home');
    }
    
    
}
