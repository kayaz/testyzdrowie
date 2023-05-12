<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ExamDate extends Model
{
    use LogsActivity;

    protected $table = 'exam_dates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exam_id',
        'exam',
        'start',
        'end'
    ];

    public function users()
    {
        return $this->hasMany('App\Models\ExamDateUser', 'exam_date_id', 'id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

//    protected $with = [
//        'exam:id,name',
//    ];

    protected $appends = [
        'color','title'
    ];

    /**
     * This will be called when fetching the element.
     */
    public function getTitleAttribute()
    {
        if(isset($this->attributes['title'])) {
            return $this->attributes['title'].' - <i class="las la-user"></i> '.$this->attributes['count'];
        }
    }

    /**
     * This will be called when fetching the element.
     */
    public function getColorAttribute()
    {
        if(isset($this->attributes['active']) && $this->attributes['active'] == 0) {
            return $this->attributes['color'] =  '#949494';
        }
        if(isset($this->attributes['active']) && $this->attributes['active'] == 1) {
            return $this->attributes['color'] =  '#1f9110';
        }
    }
}
