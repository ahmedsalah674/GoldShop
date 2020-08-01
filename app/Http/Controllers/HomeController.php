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
    public function index()
    {
        $now=\Carbon\Carbon::now()->format('m-d-Y');
        
        $day=Day::where('day',$now)->first();
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
        return view('home',compact('day'));
    }
}
