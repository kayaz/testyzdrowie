<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ExamAttempt extends Model
{
    protected $table = 'exam_attempts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'exam_id',
        'date_id',
        'answers',
        'date_start',
        'date_end',
        'answers_count',
        'answers_correct',
        'answers_empty',
        'time',
        'score',
        'questionnaire'
    ];

    /**
     * Get the user that owns the exam attempt.
     */
    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'surname', 'pesel', 'practice', 'postcode', 'city', 'address', 'phone', 'email');
    }
}
