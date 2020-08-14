<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dealing;
use App\Day;
use App\primare_sales;
use Carbon\Carbon;
class SalesController extends Controller
{
   public function display(Request $request)
    {
      $sale=Dealing::find($request->id);
       return view('Sales.display',compact('sale'));
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
      $sales=Dealing::where('type',1)->where('role',0)->paginate(10);
      return view('Sales.displaypremiums',compact('sales'));
    }

    // public function allpremiumsview(Request $request)
    // {
    //   dd($request->date);
    //   $request->date;
    // }

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
            'typetitle' => $request->typetitle,
            'role' => 0,
          ]);
          if($request->type == 0)
            {
                $day->sales+=$request->price;
                $day->total+=$request->price;
                $day->update();
            } 
        //  else
        //  {
        //   primare_sales::create([
        //     'dealing_id' => $dealing->id,
        //     'primare_sale' => $dealing->sale,
        //   ]);
        //  }
          return redirect()->back()->with('message','تم تسجيل العملية ');
        }
      else
        return redirect()->route('home')->with('error','حدث خطأ أثناء عملية التسجليل يرجي المحاولة مرة اخري');
    }
    
    public function editsales(Request $request)
    {
       $sale=Dealing::find($request->id);
       return view('Sales.editsales',compact('sale'));
    }

    public function updatesales(Request $request)
    {
      $sales=Dealing::find($request->id);
      $request = $request->except('__token');
      $sales->update($request);
      $day=Day::whereDate('created_at',carbon::now()->formate('Y-m-d'));
      return redirect()->route('display.daily.sales',$day)->with('message','لقد تم تعديل العملية');
    }
    
    
}
