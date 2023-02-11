<?php namespace App\Repositories;

use App\Models\Exam;

class ExamRepository extends BaseRepository
{
    protected $model;

    public function __construct(Exam $model)
    {
        parent::__construct($model);
    }
}
