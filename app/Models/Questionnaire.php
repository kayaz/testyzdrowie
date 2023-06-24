<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exam_id',
        'exam_date_id',
        'user_id',
        'organisation',
        'intelligibility',
        'registration',
        'tmaterials',
        'vmaterials',
        'difficulty',
        'time',
        'dodatkowe',
        'created_at'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function examDate()
    {
        return $this->belongsTo(ExamDate::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}