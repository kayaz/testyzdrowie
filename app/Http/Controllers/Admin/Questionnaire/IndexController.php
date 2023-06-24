<?php

namespace App\Http\Controllers\Admin\Questionnaire;

use App\Http\Controllers\Controller;
use App\Models\Questionnaire;

class IndexController extends Controller
{

    public function index()
    {
        $questionnaire = Questionnaire::all();

        return view("admin.questionnaire.index", ['questionnaire' => $questionnaire]);
    }

    public function show(Questionnaire $questionnaire){
        return view('admin.questionnaire.modal', ['questionnaire' => $questionnaire]);
    }

    public function destroy($id)
    {
        //
    }
}
