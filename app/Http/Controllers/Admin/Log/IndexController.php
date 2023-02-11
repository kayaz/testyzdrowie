<?php

namespace App\Http\Controllers\Admin\Log;

use App\Http\Controllers\Controller;
use App\Repositories\LogRepository;


class IndexController extends Controller
{

    private $repository;

    public function __construct(LogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('admin.log.index');
    }

    public function datatable()
    {
        return $this->repository->getDataTable();
    }
}
