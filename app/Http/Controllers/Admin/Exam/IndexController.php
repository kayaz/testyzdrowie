<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//CMS
use App\Repositories\ExamRepository;
use App\Http\Requests\ExamFormRequest;

//Models
use App\Models\Exam;
use App\Models\Question;

class IndexController extends Controller
{
    private $repository;

    public function __construct(ExamRepository $repository)
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

    public function index()
    {
        return view("admin.exam.index", ['list' => $this->repository->all()]);
    }

    public function create()
    {
        return view('admin.exam.form', [
            'cardTitle' => 'Dodaj egzamin',
            'backButton' => route('admin.exam.index')
        ])->with('entry', Exam::make());
    }

    public function store(ExamFormRequest $request)
    {
        $this->repository->create($request->validated());
        return redirect(route('admin.exam.index'))->with('success', 'Nowy egzamin dodany');
    }

    public function show(Exam $exam)
    {
        return view("admin.exam.show", ['exam' => $exam, 'list' => $exam->questions()->get()]);
    }

    public function edit(Exam $exam)
    {
        return view('admin.exam.form', [
            'entry' => $exam,
            'cardTitle' => 'Edytuj egzamin',
            'backButton' => route('admin.exam.index')
        ]);
    }

    public function update(ExamFormRequest $request, Exam $exam)
    {
        $this->repository->update($request->validated(), $exam);
        return redirect(route('admin.exam.index'))->with('success', 'Egzamin zaktualizowany');
    }

    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return response()->json('Deleted');
    }
}
