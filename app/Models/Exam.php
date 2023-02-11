<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{

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
        'date_start',
        'date_end',
        'exam_dates',
        'active',
    ];

    /**
     * Get exam questions
     */
    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }
}
