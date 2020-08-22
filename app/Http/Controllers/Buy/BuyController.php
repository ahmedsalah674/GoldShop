<?php

namespace App\Http\Controllers\Buy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dealing;
use Carbon\Carbon;
use App\Day;
class BuyController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }

   public function displaydaily(Request $request)
   {
      $date=$request->date;
      if ($request->date)
      {
        $buys=Dealing::where('role',1)->whereDate('created_at', $date)->paginate(10);
        $day=Day::whereDate('created_at',$date)->first(); 
        if(!$day)
          return redirect()->back()->with('error','لم يتم استعمال الجهاز في ذلك اليوم مطلقاً');
      }   
    else
      {
        $date=Carbon::now()->format('Y-m-d');
        $buys=Dealing::where('role',1)->whereDate('created_at',$date)->paginate(10);
        $day=Day::whereDate('created_at',$date)->first();
      }
      return view('Buys.displaydailybuy',compact(['buys','day','date']));
   }
    public function buyform()
    {
       return view('Buys.buyform');
    }
    public function storebuy(Request $request)
    {
      $now=\Carbon\Carbon::now()->format('Y-m-d');
      Dealing::create([
         'name' => $request->name,
         'tel' => $request->tel,
         'weight' => $request->weight,
         'caliber' => $request->caliber,
         'price' => $request->price,
         'type' => 0,
         'typetitle' => $request->typetitle,
         'role' => 1,
         'finsh'=>1,
       ]);
       $day=Day::whereDate('created_at',$now)->first();
       if($day)
       {
          $day->buys+=$request->price;
          $day->total-=$request->price;
          $day->update();
          return redirect()->route('display.daily.buy')->with('message','تم تسجيل العملية');
       }
        return redirect()->route('home')->with('error','حدث خطأ اثناء عملية التسجبل يرجى المحاولة مرة اخرى');
    }
    public function display($id)
    {
      $route=app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
      // return $id;
      if($route =='display.daily.buy')  
      {
          $buy=Dealing::find($id);
        if($buy)
          return view('Buys.display',compact('buy'));
        else
          return redirect()->back()->with('error','هناك خطأ أثناء عملية العرض');
      } 
      return redirect()->route('home');
    }
    public function editbuy($id)
    {
      
      $route=app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
      //return $route;
      if($route == 'display.buy' || $route == 'display.daily.buy' )
      {  
        $buy=Dealing::find($id);
        if(!$buy)
          return view('Buys.editbuy',compact('buy'));
        else
          return redirect()->back()->with('error','هناك خطأ أثناء عملية العرض');
      }
      else
        return redirect()->route('home');
    }
    public function updatebuy(Request $request)
    {
      // dd($request);
      $buys=Dealing::find($request->id);
      if($request->price != $buys->price)
         {
           $day=Day::whereDate('created_at',$buys->created_at->format('Y-m-d'))->first();
           if($day)
           {
              $day->buys-=$buys->price;
              $day->total+=$buys->price;
              $day->buys+=$request->price;
              $day->total-=$request->price;
              $day->update();
            }  
            else
            {
               return redirect()->back()->with('error','لا يمكن التعديل');
            }
         }
      $request = $request->except('__token');
      $buys->update($request);
      return redirect()->route('display.daily.buy')->with('message','لقد تم تعديل العملية');

    }
    
    
}
