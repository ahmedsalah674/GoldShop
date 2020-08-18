<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Day ;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
      $date=$request->date;
        if($date)
      {
          
        $day=Day::whereDate('created_at',$date)->first(); 
        if(!$day)
          return redirect()->back()->with('error','لم يتم استعمال الجهاز في ذلك اليوم مطلقاً');
      }   
    else
      {
        $now=\Carbon\Carbon::now()->format('Y-m-d');
        // return $now;
        $day=Day::whereDate('created_at',$now)->first();
        // return $day;
        if(!$day)
        {
            $day=Day::create([
                'day' => $now,
                'sales'=>0,
                'buys'=>0,
                'stay'=>0,
                'total'=>0,
            ]);}
        return view('home',compact(['day','date']));
      }
      return view('home',compact(['day','date']));
    }
    public function updatestay(Request $request)
    {
        // dd($request);
        $now=\Carbon\Carbon::now()->format('Y-m-d');
        $day=Day::whereDate('created_at',$now)->first();
        // return $day;
        if($day)
        {
            $day->total-=$day->stay;
            $day->stay=$request->stay;
            $day->total+=$request->stay;
            $day->update();
            return redirect()->route('home');
        }
        else
            return redirect()->route('home')->with('error','حدث خطأ اثناء التعديل ارجوا المحاولة مرة اخرى');
    }
}
