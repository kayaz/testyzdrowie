<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
class ThankYouController extends Controller
{
    public function index()
    {
        return view('front.thankyou.index');
    }
}
