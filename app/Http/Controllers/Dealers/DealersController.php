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
        dd($request);
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
    
    public function displayPremiums($id)
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

    public function storePremiums(Request $request)
    {
        $dealer=Dealer::find($request->dealer_id);
        if($dealer)
        {
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
                else
                    return redirect()->back()->with('error','حدث خطأ اثناء عملية التسجيل'); 
                    
            }
        }
    }
}
