<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index(){
        return view("front.student.index");
    }
}
