<?php namespace App\Repositories;

use App\Models\ExamDate;

class ExamDateRepository extends BaseRepository
{
    protected $model;

    public function __construct(ExamDate $model)
    {
        parent::__construct($model);
    }
}
