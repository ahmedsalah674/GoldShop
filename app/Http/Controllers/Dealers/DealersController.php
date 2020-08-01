<?php

namespace App\Http\Controllers\Dealers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DealersController extends Controller
{

    public function buyform(Request $request)
    {
        return view('Dealers.buyform');
    }
}
