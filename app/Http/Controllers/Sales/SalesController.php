<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Dealing;
use App\Day;
use App\primare_sales;
use Carbon\Carbon;
class SalesController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }

   public function display($id)
    {
      $route=app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
      if($route == 'display.daily.sales' || $route == 'premiums.page')
      {
          $sale=Dealing::find($id);
        if($sale)
        {
          $primares=$sale->primare;
          return view('Sales.display',compact(['sale','primares']));
        }
        else
          return redirect()->back()->with('error','حدث خطأ أثناء عملية عرض الصفحة');
      }
      else
        return redirect()->route('home');
    }

   public function displaydaily(Request $request)
    {
      $date=$request->date;
      if ($request->date)
        {
          $sales=Dealing::where('role',0)->whereDate('created_at', $date)->paginate(10);
          $day=Day::whereDate('created_at',$date)->first(); 
          if(!$day)
            return redirect()->back()->with('error','لم يتم استعمال الجهاز في ذلك اليوم مطلقاً');
        }   
      else
        {
          $date=Carbon::now()->format('Y-m-d');
          $sales=Dealing::where('role',0)->whereDate('created_at',$date)->paginate(10);
          $day=Day::whereDate('created_at',$date)->first();
        }
        return view('Sales.displaydailysales',compact(['sales','day','date']));
    }

    public function allpremiumspage()
    {
      $sales=Dealing::where('type',1)->where('role',0)->where('finsh','0')->paginate(10);
      return view('Sales.displaypremiums',compact('sales'));
    }
    public function dailyPremiums(Request $request)
    {
      $date=$request->date;
      // return $date; 
      if ($date)
        {
          $day=Day::whereDate('created_at',$date)->first(); 
          if(!$day)
            return redirect()->back()->with('error','لم يتم استعمال الجهاز في ذلك اليوم مطلقاً');
          $Premiums=Primare_Sales::whereDate('created_at', $date)->paginate(10);
        }   
      else
        {
          $date=Carbon::now()->format('Y-m-d');
          $Premiums=Primare_Sales::whereDate('created_at',$date)->paginate(10);
          $day=Day::whereDate('created_at',$date)->first();
        }
        // dd($Premiums,$day,$date);
        return view('Sales.daliyPrimuams',compact(['Premiums','day','date']));
    }
    public function salesform()
    {
       return view('Sales.salesform');
    }

    public function storesales(Request $request)
    {
      $now=\Carbon\Carbon::now()->format('Y-m-d');
      $day=Day::whereDate('created_at',$now)->first();
      if($day)
        {
          $dealing=Dealing::create([
            'name' => $request->name,
            'tel' => $request->tel,
            'weight' => $request->weight,
            'caliber' => $request->caliber,
            'price' => $request->price,
            'type' => $request->type,
            'finsh'=> (int)!($request->type),
            'typetitle' => $request->typetitle,
            'role' => 0,
          ]);
          if($request->type == 0)
            {
                $day->sales+=$request->price;
                $day->total+=$request->price;
                $day->update();
            } 
          return redirect()->route('display.daily.sales')->with('message','تم تسجيل العملية ');
        }
      else
        return redirect()->route('home')->with('error','حدث خطأ أثناء عملية التسجليل يرجي المحاولة مرة اخري');
    }
    
    public function editsales($id)
    {
      $route=app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
      if($route == 'display.daily.sales' || $route == 'display.sales')
      {
        $sale=Dealing::find($id);
        if($sale)
          return view('Sales.editsales',compact('sale'));
        else
        return redirect()->back()->with('error','هناك خطأ أثناء عملية عرض الصفحة');
      }
      return redirect()->route('home');
    }

    public function updatesales(Request $request)
    {
      $sales=Dealing::find($request->id);
      if($request->price != $sales->price)
         {
           $day=Day::whereDate('created_at',$sales->created_at->format('Y-m-d'))->first();
            $day->sales-=$sales->price;
            $day->total-=$sales->price;
            $day->sales+=$request->price;
            $day->total+=$request->price;
            $day->update(); 
         }
      $request = $request->except('__token');
      $sales->update($request);

      return redirect()->route('display.daily.sales')->with('message','لقد تم تعديل العملية');
    }
    public function addPraimare(Request $request)
    {
      $day=Day::whereDate('created_at',carbon::now()->format('Y-m-d'))->first();
      $sale=Dealing::find($request->dealing_id);
      if (!$day || !$sale)
        return redirect()->route('home')->with('error','حدث خطأ اثناء التسجيل يرجي المحاولة مرة اخري');
      else 
      {
       $day->primares+=$request->primare;
       $day->total+=$request->primare;
       $day->update();
      }
      $primare=Primare_Sales::create([
        'dealing_id' => $request->dealing_id,
        'primare_sale' => $request->primare,
      ]);
      if($sale->primare->sum('primare_sale') == $sale->price)
      {
        $sale->finsh=1;
        $sale->update();
      }
      return redirect()->back()->with('message','لقد تم اضافة القسط ');
    }
    public function destroy(Request $request)
    {
      $sale=Dealing::find($request->id);
      if($sale)
         {
           $day=Day::whereDate('created_at',$sale->created_at->format('Y-m-d'))->first();
           if($day)
           {
             if($sale->type == 0)
              {
                $day->sales-=$sale->price;
                $day->total-=$sale->price;
                $day->update();
                Dealing::destroy($sale->id);
              }
              else
              {
                $premiums=$sale->primare;
                if(count($premiums))
                {
                  foreach($premiums as $premium)
                  {
                    $day=Day::whereDate('created_at',$premium->created_at->format('Y-m-d'))->first();
                    $day->sales-=$premium->primare_sale;
                    $day->total-=$premium->primare_sale;
                    $day->update();
                    Primare_Sales::destroy($premium->id);
                  }
                }
                $day=Day::whereDate('created_at',$sale->created_at->format('Y-m-d'))->first();
                $day->primares-=$sale->price;
                $day->total+=$sale->price;
                $day->update();
                Dealing::destroy($sale->id);
              }
            }  
            else
            {
               return redirect()->back()->with('error','حدث خطأ');
            }
            return redirect()->back()->with('message','تمت العملية بنجاح');
         }
    }
}
