<?php

namespace App\Http\Controllers\Dealers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Dealer;
use App\Day;
use App\Dealer_Quentity;
use App\Dealer_Premium;
class DealersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function newQuantity()
    {
        $dealers=Dealer::all();
        return view('Dealers.newQuantity',compact('dealers'));
    }
    public function storeQuantity(Request $request)
    {
        if($request->dealer_id)
        {  
            $dealer=Dealer::find($request->dealer_id);
            if($dealer)
            {
                $quentity= Dealer_Quentity::create([
                    'weight'=>$request->weight,
                    'price'=>$request->price,
                    // 'typetitle'=>$request->typetitle,
                    // 'caliber'=>$request->caliber,
                    'dealer_id'=>$request->dealer_id,
                ]);
                if($quentity)
                    return redirect()->route('display.dealer',$request->dealer_id)->with('message','تم تسجيل الكمية');   
                else
                    return redirect()->route('display.dealer',$request->dealer_id)->with('error','لم يتم تسجيل الكمية يرجي المحاولة مرة اخرى');
            }
            else
                return redirect()->back()->with('error','لم يتم تسجيل الكمية يرجي المحاولة مرة اخرى');
        }
        else
            return redirect()->back()->with('error','لم يتم اختيار اي تاجر');
    }
    public function allDealers()
    {
        $dealers=Dealer::paginate(10);
        return view('Dealers.all',compact('dealers'));
    }
     public function storeDealer(Request $request)
    {
        // return $request;
        $dealer=Dealer::create([
            'name'=>$request->name,
            'tel'=>$request->tel,
            'caliber'=>$request->caliber,
            ]);
        if($dealer)
            return redirect()->back()->with('message','تم تسجيل التاجر');
        else
            return redirect()->back()->with('message','حدث خطأ حاول مرة اخري');
        
    }
    public function updateDealer(Request $request)
    {
        $dealer=Dealer::find($request->dealer_id);
        if($dealer)
        {
            $request = $request->except('__token');
            $dealer->update($request);
            return redirect()->back()->with('message','تم تعديل بيانات التاجر');
        }
    }
    public function displayDealer($id)
    {
        $route=app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
        // return $route;
        if($route=='all.dealer' || $route=='new.quantity' || $route=='display.Premiums' || $route=='display.dealer')
        {
            $dealer=Dealer::find($id);
            if($dealer)
            {
                $quantities=Dealer_Quentity::where('dealer_id',$id)->paginate(10); 
                $quantitiess=Dealer_Quentity::where('dealer_id',$id)->get();
                return view('Dealers.display',compact(['id','dealer','quantities','quantitiess']));

            }
            else
                return redirect()->back()->with('error','حدث خطأ أثناء عملية العرض');
        }
        else
            return redirect()->route('home');

    }
    
    public function displayPremiums($id)
    {
        $route=app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
        // return $route;
        if($route == 'display.dealer')
        {
            $dealer=Dealer::find($id);
            if($dealer)
                $Premiums=Dealer_Premium::where('dealer_id',$id)->paginate(10);
            else
                return redirect()->back()->with('error','حدث خطأ أثناء عملية العرض');
            if($Premiums)
                return view('Dealers.Premiums',compact(['id','Premiums']));
            else
                return redirect()->back();
        }
        else
            return redirect()->route('home');
            
    }

    public function storePremiums(Request $request)
    {
        $dealer=Dealer::find($request->dealer_id);
        $date=\Carbon\Carbon::now()->format('Y-m-d');
        $day=Day::whereDate('created_at',$date)->first();
        if(!$day)
            return redirect()->route('home')->with('error','لم يتم تسجيل العملية يرجي المحاولة مرة اخري');
        elseif($dealer)
        {
            if(!$request->premium_price && !$request->premium_gold)
                return redirect()->back()->with('error','لم يتم تسجيل القسط لعدم وجود اي بيانات');
            elseif(($dealer->quantity->sum('price') - $dealer->Premiums->sum('premium_price')) < $request->premium_price)
                return redirect()->back()->with('error','لا يمكن ان يكون مبلغ القسط اكبر من المبلغ المتبقي');
            elseif(($dealer->quantity->sum('weight') - $dealer->Premiums->sum('premium_gold')) < $request->premium_gold)
                return redirect()->back()->with('error','لا يمكن ان يكون وزن القسط اكبر من الوزن المتبقي');
            elseif($request->premium_price > $day->total)
                return redirect()->back()->with('error','لا يوجد المبلغ الكافي لأتمام العملية');
            else
            {
                $Premium= Dealer_Premium::create([
                    'dealer_id'=>$request->dealer_id,
                    'premium_price'=>$request->premium_price,
                    'premium_gold'=>$request->premium_gold,
                ]);  
                if($Premium)
                {
                    $day->dealers+=$request->premium_price;
                    $day->total-=$request->premium_price;
                    $day->update();
                    return redirect()->route('display.dealer',$dealer->id)->with('message','تم تسجبل القسط'); 
                }
                else
                    return redirect()->back()->with('error','حدث خطأ اثناء عملية التسجيل'); 
                    
            }
        }
    }
    public function destroyQuantityDealer (Request $request)
    {
        return $request;
    }
    public function updateQuantityDealer(Request $request)
    {
        return $request;
    }

    public function destroyDealerPremiums (Request $request)
    {
        return $request;
    }
    public function updateDealerPremiums(Request $request)
    {
        return $request;
    }
}
