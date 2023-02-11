<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionFormRequest;
use App\Models\Exam;
use Illuminate\Http\Request;

//CMS
use App\Repositories\QuestionRepository;

//Model
use App\Models\Question;

class QuestionController extends Controller
{
    private $repository;

    public function __construct(QuestionRepository $repository)
    {
//        $this->middleware('permission:box-list|box-create|box-edit|box-delete', [
//            'only' => ['index','store']
//        ]);
//        $this->middleware('permission:box-create', [
//            'only' => ['create','store']
//        ]);
//        $this->middleware('permission:box-edit', [
//            'only' => ['edit','update']
//        ]);
//        $this->middleware('permission:box-delete', [
//            'only' => ['destroy']
//        ]);

        $this->repository = $repository;
    }

    public function create(Exam $exam)
    {
        return view('admin.exam.question.form', [
            'cardTitle' => 'Dodaj pytanie',
            'backButton' => route('admin.exam.show', $exam),
            'exam' => $exam
        ])->with('entry', Question::make());
    }

    public function store(QuestionFormRequest $request, Exam $exam)
    {
        $this->repository->create(array_merge($request->validated(), [
            'exam_id' => $exam->id
        ]));
        return redirect(route('admin.exam.show', $exam))->with('success', 'Nowy egzamin dodany');
    }

    public function edit(Exam $exam, Question $question)
    {
        return view('admin.exam.question.form', [
            'entry' => $question,
            'cardTitle' => 'Edytuj pytanie',
            'backButton' => route('admin.exam.show', $exam),
            'exam' => $exam
        ]);
    }

    public function update(QuestionFormRequest $request,Exam $exam, Question $question)
    {
        $this->repository->update($request->validated(), $question);
        return redirect(route('admin.exam.show', $exam))->with('success', 'Pytanie zaktualizowane');
    }

    public function destroy(Exam $exam, int $id)
    {
        $this->repository->delete($id);
        return response()->json('Deleted');
    }
}
