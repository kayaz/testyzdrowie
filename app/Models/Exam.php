<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Exam extends Model
{
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'text',
        'video',
        'statute',
        'time_limit',
        'attempts',
        'question',
        'pass',
        //'date_start',
        //'date_end',
        //'exam_dates',
        'active',
    ];

    /**
     * Get exam questions
     */
    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }

    /**
     * Get exam dates
     */
    public function dates()
    {
        return $this->hasMany('App\Models\ExamDate');
    }

    /**
     * Get exam dates that have a start date before today
     */
    public function availableDates()
    {
        return $this->hasMany('App\Models\ExamDate')->where('start', '>', now()->format('Y-m-d'))->whereActive(1);
    }

    public function examDateUsers()
    {
        return $this->hasManyThrough(
            ExamDateUser::class,
            ExamDate::class,
            'exam_id', // foreign key on ExamDate table
            'exam_date_id', // foreign key on ExamDateUser table
            'id', // local key on Exam table
            'id' // local key on ExamDate table
        );
    }
}
