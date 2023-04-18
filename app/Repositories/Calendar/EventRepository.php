<?php namespace App\Repositories\Calendar;

use Carbon\Carbon;

//CMS
use App\Repositories\BaseRepository;
use App\Models\ExamDate;
use Illuminate\Support\Facades\DB;

class EventRepository extends BaseRepository implements EventRepositoryInterface
{
    protected $model;

    public function __construct(ExamDate $model)
    {
        parent::__construct($model);
    }

    public function getEvents($attributes)
    {
        $start = Carbon::parse($attributes['start'])->format('Y-m-d');
        $end = Carbon::parse($attributes['end'])->format('Y-m-d');

        return ExamDate::where('start', '>=', $start)
            ->where('start', '<=', $end)
            ->select(
                'id',
                'exam_id',
                'start',
                'end',
                DB::raw('(SELECT name FROM exams WHERE exams.id = exam_dates.exam_id) as title'),
                DB::raw('(SELECT active FROM exams WHERE exams.id = exam_dates.exam_id) as active'),
                DB::raw('(SELECT COUNT(*) FROM exam_date_users WHERE exam_date_users.exam_date_id = exam_dates.id) as count')
            )
            ->get();
    }
}

