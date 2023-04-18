<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Exam;
use App\Models\ExamDate;
use App\Models\ExamAttempt;
use App\Models\File;
use App\Models\Question;

class ExamController extends Controller
{
    protected $user_id;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user_id = Auth::user()->id;
            return $next($request);
        });
    }

    public function index(Exam $exam, ExamDate $date)
    {
        $attempt = ExamAttempt::whereUserId($this->user_id)->whereExamId($exam->id)->whereDateId($date->id);
        return view('front.exam.index', ['exam' => $exam, 'date' => $date, 'attempt' => $attempt]);
    }

    public function info(Exam $exam, ExamDate $date){

        $files = File::all()->where('exam_id', $exam->id);
        return view('front.exam.info', ['exam' => $exam, 'date' => $date, 'files' => $files]);
    }

    public function show(Exam $exam, ExamDate $date, Request $request)
    {
        $questions = Question::whereExamId($exam->id)->limit($exam->question)->inRandomOrder()->get();

        $attempt = ExamAttempt::whereUserId($this->user_id)->whereExamId($exam->id)->whereDateId($date->id);
        if($attempt->count() >= $exam->attempts) {
            return redirect()->route('student.index');
        } else {
            $examAttempt = new ExamAttempt();
            $examAttempt->user_id = $this->user_id;
            $examAttempt->exam_id = $exam->id;
            $examAttempt->date_id = $date->id;
            $examAttempt->ip = $request->ip();
            $examAttempt->host = gethostbyaddr($request->ip());
            $examAttempt->date_start = date('Y-m-d H:i:s');
            $examAttempt->save();
        }

        return view('front.exam.show', ['exam' => $exam, 'questions' => $questions, 'examAttempt' => $examAttempt->id, 'date' => $date]);
    }

    public function store(Request $request, Exam $exam, Question $question) {
        $requestData = $request->except(['_token', 'attempt']);
        $examAttempt = ExamAttempt::findOrFail($request->get('attempt'));

        $questions = $question->whereIn('id', array_map(fn($pytanie) => ltrim($pytanie, 'pytanie'), array_keys($requestData)))
            ->get(['id', 'correct'])
            ->keyBy('id');

        $answers = collect($requestData)
            ->map(function ($value, $key) use ($questions) {
                $id = ltrim($key, 'pytanie');
                $question = $questions[$id];
                $correct_wrong = $question->correct == $value ? 1 : 0;
                return [
                    'question_id' => $id,
                    'answer' => $value,
                    'correct' => $correct_wrong,
                ];
            });

        $correctAnswers = $answers->sum('correct');
        $wrongAnswers = $answers->count() - $correctAnswers;
        $emptyAnswers = $exam->question - $answers->count();
        $finalArray = $answers->toArray();

        if ($exam->question > 0) {
            $finalArray['score'] = round(($correctAnswers * 100) / $exam->question);
        } else {
            $finalArray['score'] = 0;
        }

        $date1 = Carbon::createFromFormat('Y-m-d H:i:s', $examAttempt->date_start);
        $date2 = Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

        $examAttempt->date_end = $date2;
        $examAttempt->answers_count = $answers->count();
        $examAttempt->answers_correct = $correctAnswers;
        $examAttempt->answers_wrong = $wrongAnswers;
        $examAttempt->answers_empty = $emptyAnswers;
        $examAttempt->time = $date1->diffInSeconds($date2);
        $examAttempt->score = $finalArray['score'];
        $examAttempt->save();

        return redirect()->route('exam.result', ['exam' => $exam->id, 'date' => $examAttempt->date_id, 'attempt' => $examAttempt->id]);
    }

    public function result(Exam $exam, ExamDate $date, ExamAttempt $attempt){

        $attempts = ExamAttempt::whereUserId($this->user_id)->whereExamId($exam->id)->whereDateId($date->id)->count();

        return view('front.exam.result', ['exam' => $exam, 'attempts' => $attempts, 'attempt' => $attempt, 'date' => $date]);
    }
}
