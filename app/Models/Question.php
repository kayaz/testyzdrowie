<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
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
