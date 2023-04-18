<?php

namespace App\Http\Controllers\Front;

use App\Notifications\CourseRegisterNotification;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

//CMS
use App\Repositories\ExamRepository;
use App\Models\Exam;
use App\Models\ExamDate;
use App\Models\ExamDateUser;
use Illuminate\Support\Facades\Notification;

class CourseController extends Controller
{
    use AuthenticatesUsers;
    protected string $redirectTo = '/';

    private ExamRepository $repository;

    public function __construct(ExamRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('auth')->except(['form', 'index']);
        //$this->middleware('guest')->except(['index']);
    }

    public function index()
    {

        return view("front.course.index", ['list' => $this->repository->allActive()]);
    }

    public function form()
    {
        return view("front.course.form");
    }

    public function show(Exam $exam, ExamDate $date)
    {
        $user_id = Auth::user()->id;

        // Check if exame date exist in database
        $examDate = ExamDate::whereId($date->getAttribute('id'))
            ->whereExamId($exam->getAttribute('id'))
            ->firstOrFail();

        // Check if user already register in selected exam and date
        $existRegister = ExamDateUser::whereExamDateId($date->getAttribute('id'))
            ->whereExamId($exam->getAttribute('id'))
            ->whereUserId($user_id)
            ->first();

        if($examDate) {
            return view("front.course.show", ['exam' => $exam, 'examdate' => $examDate, 'existRegister' => $existRegister]);
        } else {
            if(!$examDate){
                return redirect(route('course.index'))->with('error', 'Wybrany kurs nie istnieje.');
            }
        }
    }

    public function store(Exam $exam, ExamDate $date)
    {
        $user = Auth::user();

        // Check if exame date exist in database
        $examDate = ExamDate::whereId($date->getAttribute('id'))
            ->whereExamId($exam->getAttribute('id'))
            ->firstOrFail();

        // Check if user already register in selected exam and date
        $existRegister = ExamDateUser::whereExamDateId($date->getAttribute('id'))
            ->whereExamId($exam->getAttribute('id'))
            ->whereUserId($user->id)
            ->first();

        // If the exam exists and the user has not registered.
        if($examDate && !$existRegister) {

            ExamDateUser::create([
                'exam_date_id' => $date->getAttribute('id'),
                'exam_id' => $exam->getAttribute('id'),
                'user_id' => $user->id
            ]);

            Notification::send($user, new CourseRegisterNotification($exam, $examDate, $user));

            return redirect(route('course.show', ['exam' => $exam, 'date' => $date]))->with('success', 'Dziękujemy! Na Twój adres e-mail wysłaliśmy podsumowanie.');

        } else {
            if(!$examDate){
                return redirect(route('course.show', ['exam' => $exam, 'date' => $date]))->with('error', 'Wybrany kurs nie istnieje.');
            }
            if($existRegister){
                return redirect(route('course.show', ['exam' => $exam, 'date' => $date]))->with('error', 'Jesteś już zapisany na ten kurs.');
            }
        }
    }

    public function check(Request $request)
    {
        if($request->get('date') && $request->get('exam_id')){
            $exam = ExamDate::whereId($request->get('date'))->whereExamId($request->get('exam_id'))->firstOrFail();
            if($exam){
                return redirect(route('course.show', [$request->get('exam_id'), $request->get('date')]));
            } else {
                return redirect(route('course.index'));
            }
        } else {
            return redirect(route('course.index'));
        }
    }
}