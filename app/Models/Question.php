<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Question extends Model
{
    use LogsActivity;
    protected $table = 'exam_questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exam_id',
        'question',
        'answer_a',
        'answer_b',
        'answer_c',
        'answer_d',
        'correct',
        'position'
    ];
}
