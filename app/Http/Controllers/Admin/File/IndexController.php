<?php

namespace App\Http\Controllers\Admin\File;

use App\Http\Controllers\Controller;
use App\Models\Exam;

// CMS
use App\Models\File;
use App\Http\Requests\FileFormRequest;
use App\Repositories\FileRepository;
use App\Services\FileService;

class IndexController extends Controller
{
    private FileRepository $repository;
    private FileService $service;

    public function __construct(FileRepository $repository, FileService $service)
    {
        $this->middleware('permission:file-list|file-create|file-edit|file-delete', [
            'only' => ['index','store']
        ]);
        $this->middleware('permission:file-create', [
            'only' => ['create','store']
        ]);
        $this->middleware('permission:file-edit', [
            'only' => ['edit','update']
        ]);
        $this->middleware('permission:file-delete', [
            'only' => ['destroy']
        ]);

        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        return view('admin.file.index', ['list' => $this->repository->all()]);
    }

    public function create()
    {
        $exams = Exam::pluck('name', 'id');
        return view('admin.file.file-form', [
            'cardTitle' => 'Dodaj plik',
            'backButton' => route('admin.file.index'),
            'exams' => $exams
        ])->with('entry', File::make());
    }

    public function store(FileFormRequest $request)
    {
        $entry = $this->repository->create($request->validated());
        if ($request->hasFile('file')) {
            $this->service->upload($request->name, $request->file('file'), $entry);
        }
        return redirect(route('admin.file.index'))->with('success', 'Wpis zaktualizowany');
    }

    public function edit(int $id)
    {
        $exams = Exam::pluck('name', 'id');
        return view('admin.file.file-form', [
            'entry' => $this->repository->find($id),
            'cardTitle' => 'Edytuj plik',
            'backButton' => route('admin.file.index'),
            'exams' => $exams
        ]);
    }

    public function update(FileFormRequest $request, int $id)
    {
        $entry = $this->repository->find($id);
        $this->repository->update($request->validated(), $entry);

        if ($request->hasFile('file')) {
            $this->service->upload($request->name, $request->file('file'), $entry, 1);
        }

        return redirect(route('admin.file.index'))->with('success', 'Wpis zaktualizowany');
    }

    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return response()->json('Deleted');
    }

    public function download(File $file) {
        $file->increment('download');
        return redirect('/uploads/storage/'. $file->file);
    }
}
