<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    function index(){
        $articles = Article::paginate(10);
        return view('front.article.index', ['articles' => $articles]);
    }
}
