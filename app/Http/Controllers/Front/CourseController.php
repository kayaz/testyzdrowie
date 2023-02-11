<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class CourseController extends Controller
{
    use AuthenticatesUsers;
    protected string $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('index');
    }
    public function index()
    {
        return view("front.course.index");
    }

    public function form()
    {
        return view("front.course.form");
    }

}
