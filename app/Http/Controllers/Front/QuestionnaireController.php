<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamDate;
use Carbon\Carbon;
use Illuminate\Http\Request;

// CMS
use App\Models\Questionnaire;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
{
    public function index(Exam $exam, ExamDate $date)
    {
        $checkforquestionnaire = Questionnaire::whereUserId(Auth::user()->id)->whereExamId($exam->id)->whereExamDateId($date->id)->count();

        return view('/front/questionnaire/index', ['questionnaire' => $checkforquestionnaire]);
    }

    public function store(Request $request, Exam $exam, ExamDate $date)
    {
        Questionnaire::create([
            'exam_id' => $exam->id,
            'exam_date_id' => $date->id,
            'user_id' => Auth::user()->id,
            'organisation' => $request->get('organisation'),
            'intelligibility' => $request->get('intelligibility'),
            'registration' => $request->get('registration'),
            'tmaterials' => $request->get('tmaterials'),
            'vmaterials' => $request->get('vmaterials'),
            'difficulty' => $request->get('difficulty'),
            'time' => $request->get('time'),
            'dodatkowe' => $request->get('dodatkowe'),
            'created_at' => Carbon::now()
        ]);
        return redirect()->back()->with(
            'success',
            'Dziękujemy za wypełnienie formularza'
        );
    }
}
