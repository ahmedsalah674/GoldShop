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

    public function newQuantity()
    {
        $dealers=Dealer::all();
        return view('Dealers.newQuantity',compact('dealers'));
    }
    public function storeQuantity(Request $request)
    {
       $quentity= Dealer_Quentity::create([
            'weight'=>$request->weight,
            'price'=>$request->price,
            'typetitle'=>$request->typetitle,
            'caliber'=>$request->caliber,
            'dealer_id'=>$request->dealer_id,
        ]);
        if($quentity)
            return redirect()->route('display.dealer',$request->dealer_id)->with('message','تم تسجيل الكمية');   
        else
            return redirect()->route('display.dealer',$request->dealer_id)->with('error','لم يتم تسجيل الكمية يرجي المحاولة مرة اخرى');
    }
    public function allDealers()
    {
        $dealers=Dealer::paginate(10);
        return view('Dealers.all',compact('dealers'));
    }
     public function storeDealer(Request $request)
    {
        $dealer=Dealer::create([
            'name'=>$request->name,
            'tel'=>$request->tel,
            ]);
        return redirect()->back()->with('message','تم تسجيل التاجر');
    }
    public function updateDealer(Request $request)
    {
        $dealer=Dealer::find($request->dealer_id);
        $request = $request->except('__token');
        $dealer->update($request);
        return redirect()->back()->with('message','تم التعديل');
    }
    public function displayDealer($id)
    {
        $dealer=Dealer::find($id);
        if($dealer)
            {$quantities=Dealer_Quentity::where('dealer_id',$id)->paginate(10); 
            $quantitiess=Dealer_Quentity::where('dealer_id',$id)->get(); }
            // $quantities=$dealer->quantity;
        else
            return redirect()->route('home');
        return view('Dealers.display',compact(['id','dealer','quantities','quantitiess']));
        
    }
    
    public function displayPremiums($id)
    {
        $dealer=Dealer::find($id);
        if($dealer)
            $Premiums=Dealer_Premium::where('dealer_id',$id)->paginate(10);
        else
            return redirect()->route('home');
        return view('Dealers.Premiums',compact(['id','Premiums']));
    }

    public function storePremiums(Request $request)
    {
        $dealer=Dealer::find($request->dealer_id);
        // return $dealer->quantity->sum('price');
        if(!$request->premium_price && !$request->premium_gold)
            return redirect()->back()->with('error','لم يتم تسجيل القسط لعدم وجود اي بيانات');
        elseif(($dealer->quantity->sum('price') - $dealer->Premiums->sum('premium_price')) < $request->premium_price)
            return redirect()->back()->with('error','لا يمكن ان يكون مبلغ القسط اكبر من المبلغ المتبقي');
        elseif(($dealer->quantity->sum('weight') - $dealer->Premiums->sum('premium_gold')) < $request->premium_gold)
            return redirect()->back()->with('error','لا يمكن ان يكون وزن القسط اكبر من الوزن المتبقي');
        else
        {
            $Premium= Dealer_Premium::create([
                'dealer_id'=>$request->dealer_id,
                'premium_price'=>$request->premium_price,
                'premium_gold'=>$request->premium_gold,
            ]);  
            if($Premium)
                return redirect()->route('display.dealer',$dealer->id)->with('message','تم تسجبل القسط'); 
        }
        return $request;
    }
}
