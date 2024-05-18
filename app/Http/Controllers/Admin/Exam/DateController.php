<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Exports\ExamAttemptExport;
use App\Http\Controllers\Controller;

// CMS
use App\Http\Requests\ExamDateEditFormRequest;
use App\Http\Requests\ExamDateFormRequest;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\ExamDate;
use App\Models\ExamDateUser;
use App\Repositories\ExamDateRepository;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class DateController extends Controller
{

    private ExamDateRepository $repository;

    public function __construct(ExamDateRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(ExamDateFormRequest $request)
    {
        if (request()->ajax()) {
            $this->repository->create($request->validated());
            return response()->json(['success' => true]);
        }
    }

    public function update(ExamDateEditFormRequest $request, ExamDate $examdate)
    {
        if (request()->ajax()) {
            $this->repository->update($request->validated(), $examdate);
            return response()->json(['success' => true]);
        }
    }

    public function show(ExamDate $examdate)
    {
        $exam = Exam::find($examdate->exam_id);
        $examdateUsers = ExamDateUser::where('exam_date_id', '=', $examdate->id)->with('users')->orderBy('id', 'DESC')->get();

        return view('admin.exam.date.show', [ 'exam' => $exam, 'examdate' => $examdate, 'examdateusers' => $examdateUsers]);
    }
    public function clear(ExamDate $examdate)
    {
        ExamDateUser::where('exam_date_id', $examdate->id)->delete();
        return redirect(route('admin.examdate.show', $examdate))->with('success', 'Kurs wyczyszczony');
    }

    public function export(ExamDate $examdate)
    {
        $exam = $examdate->exam()->first();
        $filename = "export_" . date("Y-m-d_H-i", time());
        return Excel::download(new ExamAttemptExport($examdate->id, $exam->pass), Str::slug($exam->name).'_wyniki_egzaminu_'.$filename.'.xlsx');
    }


    public function index(ExamDate $examdate)
    {
        $exameAttempts = ExamAttempt::whereDateId($examdate->id)->with('user')->get();

        return view('admin.exam.date.index', [ 'examdate' => $examdate, 'exam' => $examdate->exam()->first(), 'exameAttempts' => $exameAttempts ]);
    }

    public function destroyRegister(ExamDate $examdate, ExamDateUser $examdateuser)
    {
        $examdateuser->delete();
        return response()->json(['success' => true]);
    }

    public function destroyApproach(ExamDate $examdate, ExamAttempt $approach)
    {
        $approach->delete();
        return response()->json(['success' => true]);
    }

    public function destroy(ExamDate $examdate)
    {
        $examdate->delete();
        return response()->json(['success' => true]);
    }
}
