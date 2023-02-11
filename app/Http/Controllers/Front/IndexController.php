<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

// CMS

class IndexController extends Controller
{
    public function index()
    {
        return view('front.homepage.index');
    }

}
