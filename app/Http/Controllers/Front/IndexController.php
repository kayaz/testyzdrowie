<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;

// CMS

class IndexController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('date', 'desc')->paginate(10);
        return view('front.homepage.index', ['articles' => $articles]);
    }

}
