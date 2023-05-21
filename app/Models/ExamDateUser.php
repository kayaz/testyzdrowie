<?php

namespace App\Models;

use App\Notifications\UserGrantedAccess;
use Illuminate\Database\Eloquent\Model;
class ExamDateUser extends Model
{
    protected $table = 'exam_date_users';
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
        'active'
    ];

    public function users()
    {
        return $this->hasMany('App\Models\User', 'id', 'user_id');
    }

    public function examDate()
    {
        return $this->belongsTo('App\Models\ExamDate');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($model) {
            if ($model->isDirty('active')) {
                $active = $model->active;
                $user = User::find($model->user_id);
                $user->notify(new UserGrantedAccess($active, $user, $model));
            }
        });
    }
}
